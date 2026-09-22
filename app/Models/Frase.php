<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frase extends Model
{
    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<string>
     */
    protected $fillable = [
        'persona_id',
        'frase',
    ];

    /**
     * Cada frase pertenece a una persona.
     *
     * @return BelongsTo<Persona, $this>
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}
