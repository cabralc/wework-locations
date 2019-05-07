<?php

use App\Country;
use App\Floor;
use App\Location;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $country  = factory(Country::class)->create();
        $location = factory(Location::class)->create(
            ['country' => $country->code,]
        );
        $floor    = factory(Floor::class)->create(
            ['location_id' => $location->id,]
        );
    }
}
