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
     * The URI prefix for this test suite.
     *
     * @var string
     */
    private $prefix = '/api';

    /**
     * The URI for this test.
     *
     * @var string
     */
    protected $uri = '';

    /**
     * Get the URI for this test.
     *
     * @return string
     */
    protected function path()
    {
        return $this->prefix . $this->uri;
    }

    /**
     * Assert a JSON response has an expected number of results.
     *
     * @param  int          $expected
     * @param  TestResponse $response
     * @return void
     */
    protected function assertResultsCount(int $expected, TestResponse $response)
    {
        $response->assertStatus(200);
        $this->assertCount($expected, $response->json()['data']);
    }

    /**
     * Assert the results contained within a JSON response
     * have a given structure.
     *
     * @param  TestResponse $response
     * @param  array        $structure
     * @return void
     */
    protected function assertResultHasStructure(TestResponse $response, array $structure)
    {
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                0 => $structure
            ]
        ]);
    }
}
