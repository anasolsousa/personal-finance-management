<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Transaction;
use App\Models\SubCategory;
use App\Models\Investment;

class Category extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'name',
        'icon',
    ];

    // Uma categoria pode ter várias subcategorias
    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
