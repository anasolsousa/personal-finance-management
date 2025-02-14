<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Category;
use App\Models\Transaction;

class SubCategory extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    // public function transaction(){
    //     return $this->hasMany(Transaction::class);
    // }
}
