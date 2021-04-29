<?php

namespace Tests\Feature;

use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_registered_user_can_create_a_film()
    {
        $this->signIn();

        $data = make(Film::class, [
            'photo_binary' => UploadedFile::fake()->create('test.png', $kilobytes = 0)
        ]);

        $this
            ->json('post', '/api/films', $data->toArray())
            ->assertCreated();
    }

    /** @test */
    public function a_unauthorized_user_cannot_create_a_film()
    {
        $this->withExceptionHandling();

        $data = make(Film::class, [
            'photo_binary' => UploadedFile::fake()->create('test.png', $kilobytes = 0)
        ]);

        $this
            ->json('post', '/api/films', $data->toArray())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function a_registered_user_can_update_a_film()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $updated_name = 'Updated name';
        $data = create(Film::class)->toArray();
        $data['photo_binary'] = UploadedFile::fake()->create('test.png', $kilobytes = 0);
        $data['name'] = $updated_name;

        $filmID = $data['id'];

        $response = $this
            ->json('post', "/api/films/$filmID", $data);

        $response->assertJsonPath(
            "name",
            $updated_name
        );
    }

    /** @test */
    public function a_unauthorized_user_cannot_update_a_film()
    {
        $this->withExceptionHandling();

        $data = create(Film::class)->toArray();

        $filmID = $data['id'];

        $this
            ->json('post', "/api/films/$filmID", $data)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function on_create_film_name_field_should_be_required()
    {
        $this->validateError('name');
    }

    /** @test */
    public function on_create_film_description_field_should_be_required()
    {
        $this->validateError('description');
    }

    /** @test */
    public function on_create_film_photo_binary_field_should_be_required()
    {
        $this->validateError('photo_binary');
    }

    /** @test */
    public function on_create_film_country_field_should_be_required()
    {
        $this->validateError('country');
    }

    /** @test */
    public function on_create_film_rating_field_should_be_required()
    {
        $this->validateError('rating');
    }

    /** @test */
    public function on_create_film_photo_binary_should_not_accept_url()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $response = $this
            ->json('post', "/api/films", ["photo_binary" => "url_path"]);

        $response
            ->assertJsonValidationErrors("photo_binary");
    }

    /** @test */
    public function on_create_film_photo_binary_should_only_accept_binary()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $response = $this
            ->json('post', "/api/films", ["photo_binary" => UploadedFile::fake()->create('test.png', $kilobytes = 0)]);

        $response
            ->assertJsonMissingValidationErrors("photo_binary");
    }

    protected function validateError($key)
    {
        $this->withExceptionHandling();
        $this->signIn();


        $response = $this
            ->json('post', "/api/films", []);

        $response->assertJsonValidationErrors($key);
    }
}
