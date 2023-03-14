<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'name' => 'jjjj',
            'email' => 'jjjj@h.com',
            'phone_number' => '0000',
            'gender' => 'male',
            'birthday' => '03-02-2025',
            'location' => 'caioop',
            'created_by' => 1
        ]);
    }
}
