<?php

use Carbon\Carbon;
use App\Models\House;
use App\Models\Minyan;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create_house_with_minyanim_for_days($days = 2);
        $this->create_house_with_minyanim_for_days($days = 2);
    }

    /**
     * Create a shiva house with minyanim for each day of the
     * given day count.
     *
     * @param  int    $days
     * @return [type]
     */
    protected function create_house_with_minyanim_for_days(int $days)
    {
        $house = create(House::class);

        for ($day = 0; $day < $days; $day++) {
            create(Minyan::class, [
                'type' => 'shacharis',
                'house_id' => $house->id,
                'timestamp' => Carbon::today()->addHours(7)->addDays($day)
            ]);
            create(Minyan::class, [
                'type' => 'mincha/maariv',
                'house_id' => $house->id,
                'timestamp' => Carbon::today()->addHours(18)->addDays($day)
            ]);
        }
    }
}
