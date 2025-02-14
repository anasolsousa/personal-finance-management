<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Verifica se já existe um admin
        if (!Admin::count()) {
            Admin::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123456')
            ]);
        }
    }
}
