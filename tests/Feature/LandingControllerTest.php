<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class LandingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_landing_page_dapat_diakses()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('landing');
    }

    public function test_landing_page_menampilkan_data_dari_cache()
    {
        // Buat data dummy
        $author = Author::factory()->create();
        $category = Category::factory()->create();
        $article = Article::factory()->create([
            'author_id' => $author->id,
            'category_id' => $category->id,
            'status' => 'published',
            'is_hot' => true,
        ]);

        // Panggil route untuk memicu caching
        $this->get('/');

        // Pastikan cache terisi
        $this->assertTrue(Cache::has('landing_berita_hangat'));
        $cachedData = Cache::get('landing_berita_hangat');

        $this->assertNotEmpty($cachedData);
        $this->assertEquals($article->id, $cachedData->first()->id);
    }
}
