<?php

namespace Tests\utils;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

/**
 * As of Laravel 5.4.19, exceptions thrown by the application
 * are usually caught in order to give the user a simple 500.
 * However, for testing this is not ideal as we cannot easily
 * see what the error is. Adam Wathan authored this solution.
 */
trait HandlesExceptions
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    /**
     * Disable the default Laravel exception handling.
     *
     * @return void
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            /**
             * Implementing this constructor is required by the interface.
             */
            public function __construct()
            {
                //
            }

            /**
             * Implementing report is required here.
             */
            public function report(\Exception $e)
            {
                //
            }

            /**
             * Here is where we actually re throw the exception so
             * that our test will be able to receive the error.
             *
             * @param  $request
             * @param  \Exception $e
             * @return void
             */
            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });
    }

    /**
     * Turn back on the default Laravel method of catching exceptions.
     *
     * @return $this
     */
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
