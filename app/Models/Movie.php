<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Movie
 *
 * @package App\Models
 * @property int $id
 * @property int $id_kinopoisk
 * @property string|null $url
 * @property string|null $type
 * @property string|null $title
 * @property string|null $title_alternative
 * @property string|null $tagline
 * @property string|null $description
 * @property int|null $year
 * @property string|null $poster
 * @property string|null $trailer
 * @property string|null $age
 * @property object|null $actors
 * @property object|null $countries
 * @property object|null $genres
 * @property string|null $budget
 * @property string|null $premiere_world
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Query\Builder|Movie onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereActors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCountries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereGenres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereIdKinopoisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePremiereWorld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitleAlternative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTrailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|Movie withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Movie withoutTrashed()
 * @mixin \Eloquent
 */
class Movie extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'actors'    => 'object',
        'countries' => 'object',
        'genres'    => 'object',
    ];
}
