<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['nursing','laboratory','radiology','treatment','optical','reception'];
        foreach ($departments as $department) {
            User::create([
                "name"=>"John Doe",
                "email"=> $department."@gmail.com",
                "department"=>"$department",
                "password"=> Hash::make($department)
            ]);
        }
    }
}
