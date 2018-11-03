<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheatTest extends TestCase
{
    use WithFaker;

    /** @test **/
    public function api_can_create_cheats()
    {
        $user = factory('App\User')->create();
        $cheat = [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(6, true),
            'code' => $this->faker->bothify('????????'),
            'creator_id' => $user->id,
        ];

        $response = $this->json('POST', '/api/cheats', ['cheat' => $cheat]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /** @test **/
    public function api_can_list_cheats()
    {
        $cheats = factory('App\Cheat', 50)->create();

        $response = $this->json('GET', '/api/cheats');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($cheats->toArray());
    }

    /** @test **/
    public function api_can_show_cheat()
    {
        $cheat = factory('App\Cheat')->create();

        $response = $this->json('GET', "/api/cheats/{$cheat->uuid}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($cheat->toArray());
    }
}
