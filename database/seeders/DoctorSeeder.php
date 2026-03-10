<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Doctor;

class DoctorSeeder extends Seeder {
    public function run(): void {
        $categories = [
            'Cardiology'   => [
                ['name' => 'Dr. John Smith',   'email' => 'john.cardio@hospital.com',   'password' => 'cardio123'],
                ['name' => 'Dr. Sarah Lane',   'email' => 'sarah.cardio@hospital.com',  'password' => 'cardio456'],
            ],
            'Neurology'    => [
                ['name' => 'Dr. Ahmed Khan',   'email' => 'ahmed.neuro@hospital.com',   'password' => 'neuro123'],
                ['name' => 'Dr. Emily Clark',  'email' => 'emily.neuro@hospital.com',   'password' => 'neuro456'],
            ],
            'Orthopedics'  => [
                ['name' => 'Dr. Robert Miles', 'email' => 'robert.ortho@hospital.com',  'password' => 'ortho123'],
                ['name' => 'Dr. Lisa Wong',    'email' => 'lisa.ortho@hospital.com',    'password' => 'ortho456'],
            ],
            'Pediatrics'   => [
                ['name' => 'Dr. James Hall',   'email' => 'james.pedia@hospital.com',   'password' => 'pedia123'],
                ['name' => 'Dr. Maria Lopez',  'email' => 'maria.pedia@hospital.com',   'password' => 'pedia456'],
            ],
            'Dermatology'  => [
                ['name' => 'Dr. Kevin Brown',  'email' => 'kevin.derm@hospital.com',    'password' => 'derm123'],
                ['name' => 'Dr. Nina Patel',   'email' => 'nina.derm@hospital.com',     'password' => 'derm456'],
            ],
        ];

        foreach ($categories as $categoryName => $doctors) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($doctors as $doctorData) {
                Doctor::firstOrCreate(
                    ['email' => $doctorData['email']],
                    [
                    'name'        => $doctorData['name'],
                    
                    'password'    => Hash::make($doctorData['password']),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}