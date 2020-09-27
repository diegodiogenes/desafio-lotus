<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use Faker\Factory;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test route GET /api/users with UserController@index.
     *
     * @return void
     */
    public function testIndex()
    {
        User::factory(4)->create();

        $response = $this->getJson('/api/users', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = UserResource::collection(User::paginate());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Search User by name UserController@index
     * q = 'Saturnalia'
     *
     * @return void
     */
    public function testSearchUser()
    {
        $q = 'Saturnalia';

        User::factory(['name' => 'Saturnalia'])->create();

        User::factory(4)->create();

        $response = $this->getJson('/api/users?q='.$q, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = UserResource::collection(User::where('name', 'LIKE', $q . '%')->paginate());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route GET /api/users/{user} with UserController@show.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->getJson('/api/users/' . $this->user->id, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = new UserResource($this->user);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route PUT /api/users/{user} with UserController@update
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'email' => $this->faker->unique()->safeEmail,
        ];

        $response = $this->putJson('/api/users/' . $this->user->id, $data, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.UserController.update.success'),
            ])->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }

    /**
     * Test route DELETE /api/users/{user} with UserController@destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $token = $user->createToken(config('auth.token_key'))->accessToken;

        $response = $this->deleteJson('/api/users/' . $user->id, [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.UserController.destroy.success'),
            ]);
    }
}
