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
    public function a_user_can_create_cheats()
    {
        $user = factory('App\User')->create();
        $cheat = [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(6, true),
            'code' => $this->faker->bothify('????????'),
            'creator_id' => $user->id,
        ];

        $response = $this->actingAs($user)
                         ->json('POST', '/api/cheats', ['cheat' => $cheat]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
