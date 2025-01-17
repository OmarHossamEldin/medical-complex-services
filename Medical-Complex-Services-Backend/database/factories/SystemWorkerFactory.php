<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SystemWorker;

class SystemWorkerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemWorker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stakeholder_id'=>1,
            'username'=>'admin',
            'role_id'=>1,
            'password'=>bcrypt('P@ssw0rd@admin')
        ];
    }
}
