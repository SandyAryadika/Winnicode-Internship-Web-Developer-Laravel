<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraphs(3, true),
            'status' => 'published', // atau 'draft'
            'is_hot' => $this->faker->boolean,
            'is_headline' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'is_editor_choice' => $this->faker->boolean,
            'published_at' => now(),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
