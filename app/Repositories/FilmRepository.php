<?php namespace App\Repositories;

use App\Models\Film;

class FilmRepository
{
    public function list()
    {
        return Film::paginate(1);
    }

    public function get($slug)
    {
        $film = Film::whereSlug($slug)->firstOrFail();
        return $film;
    }

    public function create($request)
    {
        $film = new Film;
        $data = $request->only($film->getFillable());
        $film->fill($data);
        return $film->save();
    }

    public function update($filmId, $request)
    {
        $film = Film::findOrFail($filmId);
        $data = $request->only($film->getFillable());
        $film->update($data);
        return $film;
    }

    public function setEntity($film)
    {
        $this->film = $film;
        return $this;
    }
}
