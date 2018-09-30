<?php

namespace Tests\Feature;

use App\Category;
use App\Http\Middleware\VerifyCsrfToken;
use App\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private $max_file_size;

    protected function setUp()
    {
        $this->max_file_size = 2048;    // 2mb

        parent::setUp();
    }

    /**
     * Get posts page
     */
    public function testPostsFetching()
    {
        $this->get('/post')
            ->assertStatus(200)
            ->assertSeeText('Posts');
    }

    /**
     * Create post page
     */
    public function testPostCreatingSuccess()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->get('/post/create')
            ->assertStatus(200)
            ->assertSeeText('Add new post');

        $category = factory(Category::class)->make();
        $post = factory(Post::class)->make(['category_id' => $category->id]);
        $this->post('/post', $post->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        // test file uploading
        list ($disk, $file_name) = ['files', 'file.jpg'];
        Storage::fake($disk);
        $file = UploadedFile::fake()->image($file_name)->size($this->max_file_size);
        $post = factory(Post::class)->make([
            'file' => $file,
        ]);
        $this->post('/post', $post->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        // assert the file was stored
        Storage::disk()->assertExists("{$disk}/{$file->hashName()}");
        Storage::disk()->delete("{$disk}/{$file->hashName()}");
    }

    /**
     * Create post page
     */
    public function testPostCreatingFailure()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->get('/post/create')
            ->assertStatus(200)
            ->assertSeeText('Add new post');

        $post = factory(Post::class)->make();

        // empty array
        $this->post('/post', [])
            ->assertStatus(302)
            ->assertSessionHasErrors('name', 'content');

        // empty name
        $this->post('/post', ['name' => $post->name])
            ->assertStatus(302)
            ->assertSessionHasErrors(['content']);

        // empty content
        $this->post('/post', ['content' => $post->content])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name']);

        // incorrect category id
        $this->post('/post', array_merge($post->toArray(), ['category_id' => 'test']))
            ->assertStatus(302)
            ->assertSessionHasErrors(['category_id']);

        // large file
        // test file uploading
        list ($disk, $file_name) = ['files', 'file.jpg'];
        Storage::fake($disk);
        $file = UploadedFile::fake()->image($file_name)->size($this->max_file_size + 1);
        $this->post('/post', array_merge($post->toArray(), [
            'file' => $file,
        ]))
            ->assertStatus(302)
            ->assertSessionHasErrors(['file']);

        // assert the file was stored
        Storage::disk()->assertMissing("{$disk}/{$file->hashName()}");
        Storage::disk()->delete("{$disk}/{$file->hashName()}");
    }

    /**
     * Show post page
     */
    public function testPostShowing()
    {
        // create new post
        $post = factory(Post::class)->create();
        $this->get("/post/{$post->id}")
            ->assertStatus(200)
            ->assertSeeText("Post: {$post->name}");
    }

    /**
     * Edit post page
     */
    public function testPostEditing()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        // create new post
        $post = factory(Post::class)->create();
        $this->get("/post/{$post->id}/edit")
            ->assertStatus(200)
            ->assertSeeText("Editing post: {$post->name}");

        $category = factory(Category::class)->make();
        $post = factory(Post::class)->make(['category_id' => $category->id]);
        $this->post("/post/{$post->id}", $post->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
    }

    /**
     * Edit post failure
     */
    public function testPostEditingFailure()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        // create new post
        $post = factory(Post::class)->create();
        $this->get("/post/{$post->id}/edit")
            ->assertStatus(200)
            ->assertSeeText("Editing post: {$post->name}");

        $post = factory(Post::class)->make();

        // empty array
        $this->post('/post', [])
            ->assertStatus(302)
            ->assertSessionHasErrors('name', 'content');

        // empty name
        $this->post('/post', ['name' => $post->name])
            ->assertStatus(302)
            ->assertSessionHasErrors(['content']);

        // empty content
        $this->post('/post', ['content' => $post->content])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name']);

        // incorrect category id
        $this->post('/post', array_merge($post->toArray(), ['category_id' => 'test']))
            ->assertStatus(302)
            ->assertSessionHasErrors(['category_id']);

        // large file
        // test file uploading
        list ($disk, $file_name) = ['files', 'file.jpg'];
        Storage::fake($disk);
        $file = UploadedFile::fake()->image($file_name)->size($this->max_file_size + 1);
        $this->post('/post', array_merge($post->toArray(), [
            'file' => $file,
        ]))
            ->assertStatus(302)
            ->assertSessionHasErrors(['file']);

        // assert the file was stored
        Storage::disk()->assertMissing("{$disk}/{$file->hashName()}");
        Storage::disk()->delete("{$disk}/{$file->hashName()}");
    }

    /**
     * Test post deleting
     */
    public function testPostDeleting()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        // create new post
        $post = factory(Post::class)->create();

        // delete it
        $this->delete("/post/{$post->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('posts', $post->toArray());
    }
}
