<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var String[]
     */
    protected $fillable = [
        'pokeapi_id',
        'name',
        'sprite_url',
        'weight',
        'height',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'weight' => 'integer',
        'height' => 'integer',
    ];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
}
