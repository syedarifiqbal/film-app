<?php

function create($class, $attributes = [], $times = null)
{
    $obj = new $class;
    return $obj->factory($times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    $obj = new $class;
    return $obj->factory($times)->make($attributes);
}