<?php

namespace Tests\Feature;

use App\Cheat;
use App\User;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Session;

class CheatTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

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
    public function api_can_create_cheats()
    {
        // create user and cheat data
        $user = factory('App\User')->create();
        $cheat = [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(6, true),
            'code' => $this->faker->bothify('????????')
        ];

        // create the cheat
        $response = $this->actingAs($user, 'api')->json(
            'POST',
            '/api/cheats',
            $cheat
        );

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /** @test **/
    public function api_can_edit_cheats()
    {
        // create user and cheat
        $user = factory('App\User')->create();
        $cheat = [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(6, true),
            'code' => $this->faker->bothify('????????'),
            'creator_id' => $user->id,
        ];
        $cheat = Cheat::create($cheat);
        $this->assertTrue($cheat->exists());

        // set a new code
        $newCode = $this->faker->bothify('????????');
        $cheat->code = $newCode;
        $this->assertTrue($cheat->isDirty());

        // update the cheat
        $response = $this->actingAs($user, 'api')->json(
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
        // create user and cheat
        $user = factory('App\User')->create();
        $cheat = [
            'name' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(6, true),
            'code' => $this->faker->bothify('????????'),
            'creator_id' => $user->id,
        ];
        $cheat = Cheat::create($cheat);
        $this->assertTrue($cheat->exists());

        $response = $this->actingAs($user, 'api')->json(
            'DELETE',
            "/api/cheats/{$cheat->uuid}"
        );
        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertNull(Cheat::find($cheat->id));
    }
}
