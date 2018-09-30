<?php

namespace Tests\Feature;

use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    Use RefreshDatabase;

    /**
     * Comment successful creation
     *
     * @return void
     */
    public function testCommentCreationSuccess()
    {
        $comment = factory(Comment::class)->make();
        $this->post('/api/comment', $comment->toArray())
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }

    /**
     * Comment creation failure
     *
     * @return void
     */
    public function testCommentCreationFailure()
    {
        $comment = factory(Comment::class)->make();

        // empty array
        $this->post('/api/comment', [])
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);

         // empty author
        $this->post('/api/comment', ['content' => $comment->content])
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);

         // empty content
        $this->post('/api/comment', ['author' => $comment->author])
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);

         // incorrect author
        $this->post('/api/comment', ['content' => $comment->content, 'author' => 'lower case'])
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);

         // incorrect author
        $this->post('/api/comment', ['content' => $comment->content, 'author' => 'Oneword'])
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);
    }
}
