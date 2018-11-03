<?php

namespace Tests\Feature;

use App\Cheat;
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

    /** @test **/
    public function api_can_edit_cheat()
    {
        $cheat = factory('App\Cheat')->create();

        $newCode = $this->faker->bothify('????????');
        $cheat->code = $newCode;
        $this->assertTrue($cheat->isDirty());

        $response = $this->json(
            'PUT',
            "/api/cheats/{$cheat->uuid}",
            ['cheat' => $cheat]
        );
        $response->assertStatus(Response::HTTP_OK);
        $updatedCheat = json_decode($response->content());

        $this->assertTrue($updatedCheat->code == $newCode);
    }

    /** @test **/
    public function api_can_destroy_cheat()
    {
        $cheat = factory('App\Cheat')->create();

        $this->assertTrue($cheat->exists());
        $response = $this->json('DELETE', "/api/cheats/{$cheat->uuid}");
        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertNull(Cheat::find($cheat->id));
    }
}
