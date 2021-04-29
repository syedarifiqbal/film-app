<?php

namespace App\Models;

use App\Core\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'gerne',
        'photo',
    ];

    protected $casts = [
        'gerne' => 'json'
    ];

    protected $sluggableAttribute = 'name';

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getPhotoAttribute(){
        return asset('storage/' . $this->attributes['photo']);
    }
}
