<?php

namespace Tests\Api\Minyanim;

use App\Models\Minyan;
use Tests\Api\TestCase;

class GetMinyanimTest extends TestCase
{
    /**
     * The API URI for this test.
     *
     * @var string
     */
    protected $uri = '/minyanim';

    /** @test */
    public function a_user_can_get_all_minyanim()
    {
        create(Minyan::class, [], 20);

        $response = $this->get($this->path());

        $this->assertResultsCount(20, $response);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_day()
    {
        createMinyanWithDate('1/3/2017', 1);
        createMinyanWithDate('2/4/2016', 2);

        $responseForDay3 = $this->get("{$this->path()}?day=3");
        $responseForDay4 = $this->get("{$this->path()}?day=4");

        $this->assertResultsCount(1, $responseForDay3);
        $this->assertResultsCount(2, $responseForDay4);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_month()
    {
        createMinyanWithDate('6/1/2017', 2);
        createMinyanWithDate('7/1/2016', 3);

        $responseForJune = $this->get("{$this->path()}?month=6");
        $responseForJuly = $this->get("{$this->path()}?month=7");

        $this->assertResultsCount(2, $responseForJune);
        $this->assertResultsCount(3, $responseForJuly);
    }

    /** @test */
    public function a_user_can_filter_minyanim_by_year()
    {
        createMinyanWithDate('1/1/2016', 4);
        createMinyanWithDate('1/1/2017', 5);

        $responseFor2016 = $this->get("{$this->path()}?year=2016");
        $responseFor2017 = $this->get("{$this->path()}?year=2017");

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

        $response = $this->get("{$this->path()}?day=3&month=1&year=2017");

        $this->assertResultsCount(2, $response);
    }

    /** @test */
    public function minyanim_have_the_following_api_structure()
    {
        $minyan = create(Minyan::class);

        $response = $this->get($this->path());

        $this->assertResultHasStructure($response, [
            'type' => $minyan->type,
            'house' => [
                'street' => $minyan->house->street,
                'city' => $minyan->house->city,
                'state' => $minyan->house->state
            ],
            'timestamp' => $minyan->timestamp
        ]);
    }
}
