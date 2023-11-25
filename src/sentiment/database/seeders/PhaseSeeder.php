<?php

namespace Database\Seeders;

use App\Models\Phase;
use App\Consts\PhaseCodeConsts;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PhaseCodeConsts::PHASE_CODE_LIST as $code => $name) {
            Phase::create([
                'name' => $name,
                'code' => $code,
            ]);
        }
    }
}
