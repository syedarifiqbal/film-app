<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // DB::statement('PRAGMA foreign_keys=on;');

        $this->disableExceptionHandling();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);

        $this->actingAs($user, 'api');

        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Throwable $e) {}
            public function render($request, \Throwable $e) {
                throw $e;
            }   
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
