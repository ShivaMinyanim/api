<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Minyan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MinyanListTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_get_all_minyanim()
    {
        create(Minyan::class, [], 20);

        $response = $this->get('api/minyanim');

        $this->assertResultsCount(20, $response);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_day()
    {
        createMinyanWithDate('1/3/2017', 1);
        createMinyanWithDate('2/4/2016', 2);

        $responseForDay3 = $this->get('api/minyanim?day=3');
        $responseForDay4 = $this->get('api/minyanim?day=4');

        $this->assertResultsCount(1, $responseForDay3);
        $this->assertResultsCount(2, $responseForDay4);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_month()
    {
        createMinyanWithDate('6/1/2017', 2);
        createMinyanWithDate('7/1/2016', 3);

        $responseForJune = $this->get('api/minyanim?month=6');
        $responseForJuly = $this->get('api/minyanim?month=7');

        $this->assertResultsCount(2, $responseForJune);
        $this->assertResultsCount(3, $responseForJuly);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_year()
    {
        createMinyanWithDate('1/1/2016', 4);
        createMinyanWithDate('1/1/2017', 5);

        $responseFor2016 = $this->get('api/minyanim?year=2016');
        $responseFor2017 = $this->get('api/minyanim?year=2017');

        $this->assertResultsCount(4, $responseFor2016);
        $this->assertResultsCount(5, $responseFor2017);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_date()
    {
        createMinyanWithDate('1/1/2017');
        createMinyanWithDate('1/2/2017');
        createMinyanWithDate('2/6/2016');
        createMinyanWithDate('1/3/2017', 2);

        $response = $this->get('api/minyanim?day=3&month=1&year=2017');

        $this->assertResultsCount(2, $response);
    }

    /** @test */
    public function minyanim_have_the_following_api_structure()
    {
        $minyan = create(Minyan::class);
        $house = $minyan->house;

        $response = $this->get('api/minyanim');

        $this->assertResultHasStructure($response, [
            'type' => $minyan->type,
            'house' => $house->toArray(),
            'timestamp' => $minyan->timestamp
        ]);
    }
}
