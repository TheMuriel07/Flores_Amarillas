<?php

namespace Tests\Feature;

use App\Models\Persona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FloresPublicasTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_pagina_de_inicio_muestra_la_bienvenida(): void
    {
        $this->get(route('inicio'))
            ->assertOk()
            ->assertSee('Flores')
            ->assertSee('Amarillas')
            ->assertSee('Tu ID');
    }

    public function test_un_id_valido_redirige_a_la_flor_de_esa_persona(): void
    {
        $persona = Persona::create([
            'nombre' => 'María',
            'codigo' => '007',
            'frase_principal' => 'Frase de María',
        ]);

        $this->post(route('verificar'), ['codigo' => '007'])
            ->assertRedirect(route('flor', '007'));

        $this->get(route('flor', '007'))
            ->assertOk()
            ->assertSee('María')
            ->assertSee('Frase de María');
    }

    public function test_un_id_inexistente_muestra_un_error(): void
    {
        $response = $this->from(route('inicio'))
            ->post(route('verificar'), ['codigo' => '999']);

        $response
            ->assertRedirect(route('inicio'))
            ->assertSessionHasErrors('codigo');

        $this->assertSame(
            'Ese ID no es válido o no existe. Revísalo e inténtalo de nuevo.',
            session('errors')->first('codigo'),
        );
    }

    public function test_acceder_directamente_a_un_id_inexistente_devuelve_404(): void
    {
        $this->get(route('flor', '999'))->assertNotFound();
    }

    public function test_una_persona_solo_ve_sus_propias_frases(): void
    {
        $ana = Persona::create(['nombre' => 'Ana', 'codigo' => '011']);
        $ana->frases()->create(['frase' => 'Frase secreta de Ana']);

        $bea = Persona::create(['nombre' => 'Bea', 'codigo' => '012']);
        $bea->frases()->create(['frase' => 'Frase secreta de Bea']);

        $response = $this->get(route('flor', '011'));

        $response
            ->assertOk()
            ->assertSee('Frase secreta de Ana')
            ->assertDontSee('Frase secreta de Bea');
    }

    public function test_una_persona_puede_tener_varias_frases(): void
    {
        $persona = Persona::create(['nombre' => 'Caro', 'codigo' => '013']);
        $persona->frases()->createMany([
            ['frase' => 'Primera frase'],
            ['frase' => 'Segunda frase'],
            ['frase' => 'Tercera frase'],
            ['frase' => 'Cuarta frase'],
        ]);

        $response = $this->get(route('flor', '013'));

        $response
            ->assertOk()
            ->assertSee('Primera frase')
            ->assertSee('Segunda frase')
            ->assertSee('Tercera frase')
            ->assertSee('Cuarta frase');
    }
}