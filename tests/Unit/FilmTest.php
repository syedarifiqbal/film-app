<?php

namespace Tests\Unit;

use App\Models\Film;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function its_should_have_comments_relation()
    {
        $film = new Film();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $film->comments);
    }
}
