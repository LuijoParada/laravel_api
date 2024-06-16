<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    protected $table = 'videos';

    protected $fillable = [
        'video_name',
        'description',
        'url',
        'thumbnail',
        'likes',
        'dislikes',
        'views',
        'id_usuario'
    ];
}
