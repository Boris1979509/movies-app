<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 * @package App\Models
 */
class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'actors'    => 'object',
        'countries' => 'object',
        'genres'    => 'object',
    ];
}
