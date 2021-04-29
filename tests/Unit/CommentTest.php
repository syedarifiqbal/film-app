<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function its_should_have_film_relation()
    {
        $film = create(Film::class);
        $comment = $film->comments()->save(make(Comment::class));
        $this->assertInstanceOf(Film::class, $comment->film);
    }

    /** @test */
    public function its_should_have_a_owner()
    {
        $user = create(User::class);

        $this->signIn($user);

        $film = create(Film::class);

        $comment = $film->comments()->save(make(Comment::class, ['user_id' => $user->id]));
        
        $this->assertInstanceOf(User::class, $comment->owner);

        $this->assertEquals($user->name, $comment->owner->name);
    }
}
