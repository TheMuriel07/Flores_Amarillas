<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Crea los datos iniciales de la página.
     * El administrador puede editarlos o eliminarlos desde el panel.
     */
    public function run(): void
    {
        $maybe = Persona::create([
            'nombre' => 'Maybe',
            'codigo' => '001',
            'frase_principal' => 'Tu sonrisa es la flor más hermosa para mi.',
            'mensaje_especial' => 'Quiero que sepas que cada vez que veo flores amarillas, pienso en ti. Eres la luz que convierte mis días grises en primavera. No cambies nunca esa manera tan bonita de mirar la vida.',
        ]);

        $maybe->frases()->createMany([
            ['frase' => 'Gracias por existir y por llenar mis días de alegría.'],
            ['frase' => 'El mundo es un lugar más bonito cuando estás tú.'],
            ['frase' => 'Que esta flor amarilla ilumine tu día como tú iluminas el mío.'],
            ['frase' => 'Eres de esas personas que dejan huellas de sol dondequiera que pasan.'],
        ]);

        $lucia = Persona::create([
            'nombre' => 'Lucía',
            'codigo' => '002',
            'frase_principal' => 'Las flores amarillas florecen cada año, y tú floreces en mi corazón todos los días.',
            'mensaje_especial' => 'Gracias por cada risa compartida, por cada abrazo y por hacer que todo valga la pena. Este ramo de palabras es pequeño comparado con lo grande que es mi cariño por ti.',
        ]);

        $lucia->frases()->createMany([
            ['frase' => 'Con tus abrazos hasta los días más difíciles se vuelven tibios.'],
            ['frase' => 'Si tuviera que elegir una flor para representarte, sería la más amarilla y brillante del jardín.'],
        ]);
    }
}
