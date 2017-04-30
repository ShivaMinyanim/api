<?php

namespace Tests\Api;

use Tests\Utils\HandlesExceptions;
use Tests\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use HandlesExceptions, DatabaseMigrations;

    /**
     * Assert a JSON response has an expected number of results.
     *
     * @param  int          $expected
     * @param  TestResponse $response
     * @return void
     */
    protected function assertResultsCount(int $expected, TestResponse $response)
    {
        $this->assertCount($expected, $response->json()['data']);
    }
}
