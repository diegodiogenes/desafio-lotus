<?php

namespace Tests;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $user;
    protected $faker;
    protected $token;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install');
        Artisan::call('db:seed');

        $this->user = User::factory()->create();
        $this->token = $this->user->createToken(config('auth.token_key'))->accessToken;
        $this->faker = Factory::create('pt_BR');
    }
}
