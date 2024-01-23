<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'name', 'year', 'genre', 'country', 'duration', 'url_image',
    ];

    // El resto de tu lógica de modelo...
}
