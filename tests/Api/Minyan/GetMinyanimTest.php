<?php

namespace Tests\Api\Minyanim;

use Carbon\Carbon;
use App\Models\Minyan;
use Tests\Api\TestCase;

class GetMinyanimTest extends TestCase
{
    /** @test */
    public function a_user_can_get_all_minyanim()
    {
        create(Minyan::class, [], 20);

        $response = $this->get('api/minyanim');

        $response->assertStatus(200);
        $this->assertResultsCount(20, $response);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_year()
    {
        $minyanimIn2016 = createMinyanWithDate('1/1/2016', 4);
        $minyanimIn2017 = createMinyanWithDate('1/1/2017', 5);

        $responseFor2016 = $this->get('api/minyanim?year=2016');
        $responseFor2016->assertStatus(200);
        $this->assertResultsCount(4, $responseFor2016);

        $responseFor2017 = $this->get('api/minyanim?year=2017');
        $responseFor2017->assertStatus(200);
        $this->assertResultsCount(5, $responseFor2017);
    }

    // minyan filters i might want:
    // ////////////////////////
    // by today
    // by different day
    // by week
    // by upcoming week
    // by shiva house
    // by shul
    // by community
    // past??
}
