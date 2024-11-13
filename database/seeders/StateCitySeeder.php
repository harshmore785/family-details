<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class StateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'Maharashtra' => ['Mumbai', 'Pune', 'Nashik'],
            'Gujrat' => ['Ahemdabad', 'Surat', 'Daman'],
            'Rajasthan' => ['Jaipur', 'Jaisalmer', 'Ajmer']
        ];

        foreach ($states as $stateName => $cities) {
            $state = State::create(['name' => $stateName]);

            foreach ($cities as $cityName) {
                City::create(['name' => $cityName, 'state_id' => $state->id]);
            }
        }

    }
}
