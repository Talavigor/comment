<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function getConnection()
    {
        $pdo = new PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    public function testsCommentAreCreated()
    {

        $payload = [
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'text_comment' => 'pppppppppppppppppppppppppp',
        ];

        $this->json('POST', '/comments', $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'name' => 'Test',
                'email' => 'test@gmail.com',
                'text_comment' => 'pppppppppppppppppppppppppp',
            ]);
    }

    public function testsCommentAreUpdated()
    {

        $comment = factory(Comment::class)->create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'text_comment' => 'pppppppppppppppppppppppppp',
        ]);

        $payload = [
            'name' => 'Test1',
            'email' => 'test@gmail.com1',
            'text_comment' => 'pppppppppppppppppppppppppp1',
        ];

        $response = $this->json('PUT', '/comments/' . $comment->id, $payload)
            ->assertStatus(302)
            ->assertRedirect('/comments');


    }

    public function testsCommentAreDeleted()
    {
        $comment = factory(Comment::class)->create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'text_comment' => 'pppppppppppppppppppppppppp',
        ]);

        $this->json('DELETE', 'comments/' . $comment->id, [])
            ->assertStatus(200);
    }

    public function testCommentAreListed()
    {
        factory(Comment::class)->create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'text_comment' => 'pppppppppppppppppppppppppp',
        ]);

        $response = $this->json('GET', '/comments', [])
            ->assertStatus(200);
        $response =   $this->call('GET', '/comments');
        $view = $response->original;
        $response->assertViewIs('layouts.comments');






    }
}
