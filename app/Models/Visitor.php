<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'user_agent', 'last_activity'];

    public function postViews()
    {
        return $this->hasMany(PostView::class);
    }
}
