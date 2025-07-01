<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Sales'],
            ['name' => 'Dispatch'],
            ['name' => 'Assembly'],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate($department);
        }
    }
}
