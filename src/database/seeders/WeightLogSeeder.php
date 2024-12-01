<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;

class WeightLogSeeder extends Seeder
{

    public function run()
    {
        $users = User::all();


        WeightLog::factory()->count(35)->create([
            'user_id' => $users->random()->id,
        ]);
    }
}
