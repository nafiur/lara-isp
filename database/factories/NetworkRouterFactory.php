<?php

namespace Database\Factories;

use App\Domain\Network\Models\Router;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Router>
 */
class NetworkRouterFactory extends Factory
{
    protected $model = Router::class;

    public function definition(): array
    {
        $name = $this->faker->company.' Router';

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(4)),
            'host' => $this->faker->ipv4(),
            'api_port' => 8728,
            'username' => 'admin',
            'password' => 'password',
            'connection_type' => 'api',
            'use_ssl' => false,
            'status' => 'active',
            'meta' => [],
        ];
    }
}
