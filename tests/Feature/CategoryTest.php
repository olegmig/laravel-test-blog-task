<?php

namespace Tests\Feature;

use App\Category;
use App\Http\Middleware\VerifyCsrfToken;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get categories page
     */
    public function testCategoriesFetching()
    {
        $this->get('/category')
            ->assertStatus(200)
            ->assertSeeText('Categories');
    }

    /**
     * Create category page
     */
    public function testCategoryCreatingSuccess()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->get('/category/create')
            ->assertStatus(200)
            ->assertSeeText('Add new category');

        $category = factory(Category::class)->make();
        $this->post('/category', $category->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
    }

    /**
     * Show category page
     */
    public function testCategoryShowing()
    {
        // create new category
        $category = factory(Category::class)->create();
        $this->get("/category/{$category->id}")
            ->assertStatus(200)
            ->assertSeeText("Category: {$category->name}");
    }

    /**
     * Edit category page
     */
    public function testCategoryEditingSuccess()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        // create new category
        $category = factory(Category::class)->create();
        $this->get("/category/{$category->id}/edit")
            ->assertStatus(200)
            ->assertSeeText("Editing category: {$category->name}");

        $category = factory(Category::class)->make();
        $this->post("/category/{$category->id}", $category->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
    }
}
