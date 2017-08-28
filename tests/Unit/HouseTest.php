<?php

use Tests\TestCase;
use App\Models\House;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HouseTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_residence_name()
    {
        $house = create(House::class, ['residence_name' => 'Smith Residence']);

        $this->assertEquals('Smith Residence', $house->residence_name);
    }

    /** @test */
    public function it_has_a_street_address()
    {
        $house = create(House::class, ['street' => '123 Sesame St.']);

        $this->assertEquals('123 Sesame St.', $house->street);
    }

    /** @test */
    public function it_has_a_city()
    {
        $house = create(House::class, ['city' => 'Fake City']);

        $this->assertEquals('Fake City', $house->city);
    }

    /** @test */
    public function it_has_a_state()
    {
        $house = create(House::class, ['state' => 'Fake State']);

        $this->assertEquals('Fake State', $house->state);
    }
}
