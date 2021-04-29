<?php

namespace App\Core\Traits;

use Illuminate\Support\Str;

/**
 * Sluggable
 */
trait Sluggable
{
    public static function bootSluggable()
    {
        self::saving(function (self $entity) {
            $slug = Str::of($entity->{$entity->sluggableAttribute})->slug('-');

            $original = $slug;

            $count = 1;
            
            while (static::whereSlug($slug)->exists()) {

                $slug = "{$original}-" . $count++;
            }

            $entity->slug = $slug;
        });
    }
}
