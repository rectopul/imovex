<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body', 'post_id'];


    public function getStatusClassAttribute() {
        switch($this->attributes['status']) {
            case 'AP':
                return 'success';
                break;
            case 'SP':
                return 'warning';
                break;
            case 'BL':
                return 'danger';
                break;
            default:
                return 'light';
                break;
        }
    }

    public function getStatusTextAttribute() {
        switch($this->attributes['status']) {
            case 'AP':
                return 'APROVADO';
                break;
            case 'SP':
                return 'SPAM';
                break;
            case 'BL':
                return 'BLOQUEADO';
                break;
            default:
                return 'SEM MODERAÇÃO';
                break;
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
