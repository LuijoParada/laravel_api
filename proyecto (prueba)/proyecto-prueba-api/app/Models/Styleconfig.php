<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Styleconfig extends Model
{
    use HasFactory;

    protected $table = 'styleconfig';

    protected $fillable = [
        'primaryColor',
        'secondaryColor',
        'tertiaryColor',
        'titleColor',
        'subtitleColor',
        'pColor',
        'bgBtnColor',
        'texBtnColor'   
    ];
}
