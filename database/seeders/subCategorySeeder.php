<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;  
use App\Models\SubCategory;
use App\Models\Category;

class subCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $habitationCategory = Category::where('name', 'Habitação')->first();
        $transportCategory = Category::where('name', 'Transporte')->first();
        $leisureCategory = Category::where('name', 'Lazer e Entretenimento')->first();
        $educationCategory = Category::where('name', 'Educação')->first();
        $shoppingCategory = Category::where('name', 'Compras e Vestuário')->first();
        $taxesCategory = Category::where('name', 'Impostos e Taxas')->first();
        $insuranceCategory = Category::where('name', 'Seguros')->first();
        $debtsLoansCategory = Category::where('name', 'Dívidas e Empréstimos')->first();
        $donationsCategory = Category::where('name', 'Doações e Caridade')->first();
        $healthCategory = Category::where('name', 'Saúde')->first();
        $salaryCategory = Category::where('name', 'Vencimento')->first();
        $othersCategory = Category::where('name', 'Outros')->first();

        DB::table('sub_categories')->insert([
            // Habitação
            [
                'id' => Str::uuid(),
                'name' => 'Renda',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Hipoteca',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Condomínio',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Contas de eletricidade, gás e água',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Internet e telecomunicações',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Manutenção e reparações da casa',
                'category_id' => $habitationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Transporte
            [
                'id' => Str::uuid(),
                'name' => 'Combustível',
                'category_id' => $transportCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seguro do carro',
                'category_id' => $transportCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Manutenção do carro',
                'category_id' => $transportCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Transporte público',
                'category_id' => $transportCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Lazer e Entretenimento
            [
                'id' => Str::uuid(),
                'name' => 'Cinema',
                'category_id' => $leisureCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Teatro',
                'category_id' => $leisureCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Concertos e Festivais',
                'category_id' => $leisureCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Viagens e Turismo',
                'category_id' => $leisureCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Educação
            [
                'id' => Str::uuid(),
                'name' => 'Mensalidade escolar',
                'category_id' => $educationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Cursos e Formação',
                'category_id' => $educationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Livros e materiais',
                'category_id' => $educationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Plataformas online (ex: Coursera)',
                'category_id' => $educationCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Compras e Vestuário
            [
                'id' => Str::uuid(),
                'name' => 'Roupas e acessórios',
                'category_id' => $shoppingCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Produtos eletrônicos',
                'category_id' => $shoppingCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Calçados',
                'category_id' => $shoppingCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Acessórios de moda',
                'category_id' => $shoppingCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Impostos e Taxas
            [
                'id' => Str::uuid(),
                'name' => 'Imposto de Renda',
                'category_id' => $taxesCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Impostos municipais',
                'category_id' => $taxesCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Taxa de propriedade',
                'category_id' => $taxesCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Multas e infrações',
                'category_id' => $taxesCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Seguros
            [
                'id' => Str::uuid(),
                'name' => 'Seguro de saúde',
                'category_id' => $insuranceCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seguro de vida',
                'category_id' => $insuranceCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seguro de carro',
                'category_id' => $insuranceCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seguro de casa',
                'category_id' => $insuranceCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Outros',
                'category_id' => $othersCategory->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
