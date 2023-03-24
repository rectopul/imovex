<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyView extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['property_id', 'visitor_id', 'viewed_at'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
