<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'user_id' => null, // jika ada relasi ke User, bisa diganti User::factory()
            'name' => $this->faker->name,
            'bio' => $this->faker->paragraph,
            'photo' => 'default.jpg', // atau bisa random url
        ];
    }
}
