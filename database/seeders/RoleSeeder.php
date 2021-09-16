<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Manager',
                'slug' => 'manager'
            ],
            [
                'name' => 'Employee',
                'slug' => 'employee'
            ]
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate($role);
        }
    }
}
