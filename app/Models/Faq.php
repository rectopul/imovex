<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Faq extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'description', 'body'];

    public function scopeByLetter($query, $letter)
    {
        return $query->orderBy('title')->where('title', 'like', $letter.'%');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('body', 'like', '%'.$search.'%');
    }

    public function getSlugOptions() :SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeMostViewedAtMonth($query)
    {
        return $query
        ->whereHas('views', function($query){
            $query->whereMonth('viewed_at', now()->month);
            $query->whereYear('viewed_at', now()->year);
        })
        ->withCount('views')
        ->orderBy('views_count');
    }

    public function views()
    {
        return $this->hasMany(FaqView::class);
    }
}
