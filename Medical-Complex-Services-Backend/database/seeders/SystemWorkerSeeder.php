<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SystemWorker::factory(1)->create();
    }
}
