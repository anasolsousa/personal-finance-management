<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;  
use App\Models\Entity;
use App\Models\SubEntity;

class SubEntitySeeder extends Seeder
{
    public function run(): void
    {
        $bankCommercials = Entity::where('name', 'Bancos Comerciais')->first();
        $digitalBanks = Entity::where('name', 'Bancos Digitais')->first();
        $insurances = Entity::where('name', 'Seguradoras')->first();
        $utilitiesServices = Entity::where('name', 'Utilities e Serviços Públicos')->first();
        $telecommunications = Entity::where('name', 'Telecomunicações')->first();
        $supermarketsCommerce = Entity::where('name', 'Supermercados e Comércio')->first();
        $pharmaciesHealth = Entity::where('name', 'Farmácias e Saúde')->first();
        $techStores = Entity::where('name', 'Lojas de Tecnologia')->first();
        $airlines = Entity::where('name', 'Companhias Aéreas')->first();
        $transportation = Entity::where('name', 'Transportes')->first();
        $ecommerceServices = Entity::where('name', 'E-commerce e Serviços Online')->first();
        $restaurantsDelivery = Entity::where('name', 'Restauração e Delivery')->first();
        $paymentServices = Entity::where('name', 'Serviços de Pagamento')->first();

        DB::table('sub_entities')->insert([
            // Bancos Comerciais
            [
                'id' => Str::uuid(),
                'name' => 'Millennium BCP',
                'entity_id' => $bankCommercials->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Caixa Geral de Depósitos',
                'entity_id' => $bankCommercials->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Bancos Digitais
            [
                'id' => Str::uuid(),
                'name' => 'Revolut',
                'entity_id' => $digitalBanks->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'N26',
                'entity_id' => $digitalBanks->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Seguradoras
            [
                'id' => Str::uuid(),
                'name' => 'Fidelidade',
                'entity_id' => $insurances->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Allianz',
                'entity_id' => $insurances->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Utilities e Serviços Públicos
            [
                'id' => Str::uuid(),
                'name' => 'EDP',
                'entity_id' => $utilitiesServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Galp Energia',
                'entity_id' => $utilitiesServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Telecomunicações
            [
                'id' => Str::uuid(),
                'name' => 'NOS',
                'entity_id' => $telecommunications->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'MEO',
                'entity_id' => $telecommunications->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Supermercados e Comércio
            [
                'id' => Str::uuid(),
                'name' => 'Pingo Doce',
                'entity_id' => $supermarketsCommerce->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Continente',
                'entity_id' => $supermarketsCommerce->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Farmácias e Saúde
            [
                'id' => Str::uuid(),
                'name' => 'Farmácia São João',
                'entity_id' => $pharmaciesHealth->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Farmácia do Bairro',
                'entity_id' => $pharmaciesHealth->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Lojas de Tecnologia
            [
                'id' => Str::uuid(),
                'name' => 'Worten',
                'entity_id' => $techStores->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Fnac',
                'entity_id' => $techStores->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Companhias Aéreas
            [
                'id' => Str::uuid(),
                'name' => 'TAP Air Portugal',
                'entity_id' => $airlines->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'EasyJet',
                'entity_id' => $airlines->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Transportes
            [
                'id' => Str::uuid(),
                'name' => 'Carris',
                'entity_id' => $transportation->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Uber',
                'entity_id' => $transportation->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // E-commerce e Serviços Online
            [
                'id' => Str::uuid(),
                'name' => 'Amazon',
                'entity_id' => $ecommerceServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'eBay',
                'entity_id' => $ecommerceServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Restauração e Delivery
            [
                'id' => Str::uuid(),
                'name' => 'Uber Eats',
                'entity_id' => $restaurantsDelivery->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Glovo',
                'entity_id' => $restaurantsDelivery->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Serviços de Pagamento
            [
                'id' => Str::uuid(),
                'name' => 'PayPal',
                'entity_id' => $paymentServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Stripe',
                'entity_id' => $paymentServices->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
