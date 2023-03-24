<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['visitor_id', 'post_id', 'viewed_at'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
