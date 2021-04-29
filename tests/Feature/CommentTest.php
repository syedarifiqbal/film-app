<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_registered_user_can_post_a_comment()
    {
        $this->signIn();

        $film = create(Film::class);
        
        $comment = make(Comment::class);

        $this
            ->json('post', "/api/films/$film->id/comments", $comment->toArray())
            ->assertCreated();
    }

    /** @test */
    public function a_unauthorized_user_cannot_post_a_comment()
    {
        $this->withExceptionHandling();
        
        $film = create(Film::class);
        $comment = make(Comment::class);

        $this
            ->json('post', "/api/films/$film->id/comments", $comment->toArray())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
