<?php

namespace Tests\utils;

use Illuminate\Foundation\Testing\TestResponse;

trait InteractsWithJson
{
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
        $this->assertCount($expected, $response->json());
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
            0 => $structure
        ]);
    }
}
