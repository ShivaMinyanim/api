<?php

namespace Tests\Feature;

use App\Minyan;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GetMinyanimBySecularDateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_get_minyanim_for_a_secular_date()
    {
        $date = Carbon::createFromDate(2017, 4, 24);
        factory(Minyan::class, 2)->create(['timestamp' => $date]);

        $response = $this->get("/api/minyanim?month={$date->month}&day={$date->day}&year={$date->year}")
            ->assertStatus(200);

        $this->assertResultsCount(2, $response);
    }

    protected function assertResultsCount(int $expected, TestResponse $response)
    {
        $this->assertCount($expected, $response->json()['data']);
    }
}
