<?php

namespace App\Models;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasRelationships;

    protected $fillable = ['name'];
    
    public function scopeMostRead($query)
    {
        return $query->withCount('views')->orderBy('views_count', 'desc');
    }

    public function posts() 
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }

    public function views()
    {
        return $this->hasManyDeep(PostView::class, 
            ['category_post', Post::class],
            [           
               'category_id',
               'id',
               'post_id'
            ]
        );
    }
}
