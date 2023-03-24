<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model
{   
    use HasFactory, HasSlug;

    protected $fillable = [
        // 'cover', 
        'title', 
        'description', 
        'body', 
        'slug',
        'at_home',
        'publish',
        'highlight',
        'user_id'
    ];

    protected $dates = ['created_at', 'publish'];

    protected $appends = [
        'short_description',
        'short_title',
        'status',
        'status_color'
    ];

    public function getSlugOptions() :SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('publish', '<=', now());
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orWhere('body', 'like', '%'.$search.'%');
    }
    
    public function scopeWherePublished($query)
    {
        return $query->whereNotNull('publish')
        ->where('publish', '<=', now())
        ->orderBy('publish', 'desc')
        ->withCasts([
            'publish' => 'datetime:d/m/Y'
        ]);
    }

    public function scopeMostRead($query)
    {
        return $query
            ->wherePublished()
            ->withCount('views')
            ->orderBy('views_count', 'desc');
    }

    public function getCoverAttribute()
    {
        // return $this->attributes['cover'];
        return asset('img/'.$this->attributes['cover']);
    }

    public function getPublishAttribute($value) 
    {
        return $value != null ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    public function setPublishAttribute($value)
    {
        $this->attributes['publish'] = ($value != 'null' && $value != null) ?
            Carbon::createFromFormat('d/m/Y', $value) : 
            null;
    }

    public function getShortDescriptionAttribute()
    {
        return Str::of($this->attributes['description'] ?? $this->attributes['body'])->limit(105);
    }

    public function getShortTitleAttribute()
    {
        return Str::of($this->attributes['title'])->limit(21);
    }

    public function getStatusAttribute()
    {
        $publishDate = $this->attributes['publish'];
        $today = now();

        if(is_null($publishDate)) return 'Não publicado';
        if($publishDate <= $today) return 'Publicado';
        if($publishDate > $today) return 'Agendado';

    }

    public function getStatusColorAttribute()
    {
        if($this->status === 'Não publicado') return 'secondary';
        if($this->status === 'Agendado') return 'info';
        if($this->status === 'Publicado') return 'success';
    }

    public function categories() 
    {
        return $this->belongsToMany(PostCategory::class, 'category_post', 'post_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(PostComment::class)->where('status', 'AP');
    }

    public function views() 
    {
        return $this->hasMany(PostView::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
