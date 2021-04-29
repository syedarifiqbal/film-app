<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Film;

class CommentRepository
{
    public function list($filmId)
    {
        return Comment::with('owner:id,name')
            ->whereFilmId($filmId)
            ->paginate(1);
    }

    public function create($request, $filmId)
    {
        $film = Film::findOrFail($filmId);

        $comment = new Comment();

        $data = $request->only($comment->getFillable());

        $comment->fill($data);

        $comment->owner()->associate(auth(!request()->wantsJson()? :'api')->user());

        return $film->comments()->save($comment);
    }

    public function update($film, $request)
    {
        $data = $request->only($film->getFillable());
        $film->fill($data);
        return $film->save();
    }

    public function setEntity($film)
    {
        $this->film = $film;
        return $this;
    }
}
