<?php

namespace Database\Seeders;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Department::where('name', '=', 'Nursing')->exists() and
            !Department::where('name', '=', 'Laboratory')->exists() and
            !Department::where('name', '=', 'Radiology')->exists() and
            !Department::where('name', '=', 'Treatment')->exists() and
            !Department::where('name', '=', 'Optical')->exists() and
            !Department::where('name', '=', 'Reception')->exists())
        {
            DB::table('departments')->insert([
                ['name' => 'Nursing'],
                ['name' => 'Laboratory'],
                ['name' => 'Radiology'],
                ['name' => 'Treatment'],
                ['name' => 'Optical'],
                ['name' => 'Reception'],
            ]);
        }
    }
}
