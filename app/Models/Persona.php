<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'frase_principal',
        'mensaje_especial',
        'foto',
    ];

    /**
     * Una persona puede tener muchas frases.
     *
     * @return HasMany<Frase, $this>
     */
    public function frases(): HasMany
    {
        return $this->hasMany(Frase::class)->orderBy('created_at')->orderBy('id');
    }
}
