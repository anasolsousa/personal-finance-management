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

    // public function transactions(){
    //     return $this->hasMany(Transaction::class);
    // }

    // public function investments(){
    //     return $this->hasMany(Investment::class);
    // }

    // Uma categoria pode ter várias subcategorias
    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'categoria_id');
    }
}
