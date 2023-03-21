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
        Patient::factory(10)->create();
        Patient::create([
            'name' => 'jjjj',
            'email' => 'jjjj@h.com',
            'phone_number' => '0000',
            'gender' => 'male',
            'birthday' => '2005-02-04',
            'location' => 'caioop',
            'created_by' => 7
        ]);
    }
}
