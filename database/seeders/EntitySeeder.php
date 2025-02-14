<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;  

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * ACRESCENTAR A RESTANTE LISTA
     */
    public function run(): void
    {
        DB::table('entities')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Bancos Comerciais',
                'icon' => 'landmark',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Bancos Digitais',
                'icon' => 'landmark',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seguradoras',
                'icon' => 'shield',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Utilities e Serviços Públicos',
                'icon' => 'lightbulb',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Telecomunicações',
                'icon' => 'monitor-smartphone',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Supermercados e Comércio',
                'icon' => 'shopping-basket',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Farmácias e Saúde',
                'icon' => 'cross',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Lojas de Tecnologia',
                'icon' => 'laptop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Companhias Aéreas',
                'icon' => 'plane',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Transportes',
                'icon' => 'bus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'E-commerce e Serviços Online',
                'icon' => 'shopping-bag',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Restauração e Delivery',
                'icon' => 'utensils-crossed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Serviços de Pagamento',
                'icon' => 'credit-card',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
