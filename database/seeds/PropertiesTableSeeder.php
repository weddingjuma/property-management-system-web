<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Property::class, 50)->create()->each(function($property) {
            $property->devices()->save(factory(App\Device::class)->make());
        });
    }
}

