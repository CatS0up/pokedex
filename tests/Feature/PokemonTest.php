<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    /** @test */
    public function it_should_create_new_pokemon_data(): void
    {
        $this->createTypes();

        $response = $this
            ->actingAs($this->user)
            ->from('pokemons/create')
            ->post(
            uri: '/pokemons',
            data: [
                'name' => 'pikachu',
                'sprite_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png',
                'weight' => 60,
                'height' => 4,
                'types' => ['123e4567-e89b-12d3-a456-426614174000', '123e4567-e89b-12d3-a456-426614174001'],
            ]);

            $this->followingRedirects();

            $response
                ->assertStatus(302)
                ->assertRedirect('pokemons')
                ->assertSessionHas('info', 'pikachu has been created.');

                $this->assertEquals(1, Pokemon::count());

                $pokemon = Pokemon::query()->first();
                $this->assertEquals('pikachu', $pokemon->name);
                $this->assertEquals('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png', $pokemon->sprite_url);
                $this->assertEquals(60, $pokemon->weight);
                $this->assertEquals(4, $pokemon->height);

                $this->assertEquals(2, $pokemon->types->count());
    }

    /** @test */
    public function it_should_update_existing_pokemon_data(): void
    {
        $this->createTypes();

        $pikachu = Pokemon::factory()->create([
            'name' => 'pikachu',
            'sprite_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png',
            'weight' => 60,
            'height' => 4,
        ]);

        $pikachu->types()->sync(['123e4567-e89b-12d3-a456-426614174000', '123e4567-e89b-12d3-a456-426614174001']);

        $response = $this
            ->actingAs($this->user)
            ->from('pokemons/edit')
            ->put(
                uri: "/pokemons/{$pikachu->uuid}",
                data: [
                    'name' => 'raichu',
                    'sprite_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/26.png',
                    'weight' => 70,
                    'height' => 8,
                    'types' => ['123e4567-e89b-12d3-a456-426614174000'],
                ]
            );

        $this->followingRedirects();

        $response
            ->assertStatus(302)
            ->assertRedirect('pokemons')
            ->assertSessionHas('info', 'Pokemon has been updated.');

        $this->assertEquals(1, Pokemon::count());

        $pokemon = Pokemon::query()->first();
        $this->assertEquals($pikachu->uuid, $pokemon->uuid);
        $this->assertEquals('raichu', $pokemon->name);
        $this->assertEquals('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/26.png', $pokemon->sprite_url);
        $this->assertEquals(70, $pokemon->weight);
        $this->assertEquals(8, $pokemon->height);

        $this->assertEquals(1, $pokemon->types->count());
    }

    private function createUser(): User
    {
        return User::factory()->make();
    }

    private function createTypes(): void
    {
        Type::factory(2)
            ->state(new Sequence(
                ['uuid' => '123e4567-e89b-12d3-a456-426614174000'],
                ['uuid' => '123e4567-e89b-12d3-a456-426614174001'],
            ))
            ->create();
    }
}
