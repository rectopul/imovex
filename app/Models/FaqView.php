<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqView extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['faq_id', 'visitor_id', 'viewed_at'];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
