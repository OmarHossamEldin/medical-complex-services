<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Stakeholder::factory(1)->create();
    }
}
