<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Category\Category;
use App\Models\Entity\Entity;
use App\Models\Account;
class Transaction extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'date',
        'notes',
        'amount',
        'type',
        'payment_method',
        'account_id', 
        'entity_id',
        'sub_entity_id',
        'category_id',
        'sub_category_id'
    ];

     public static function Types()
     {
         return [
             'expense',
             'income',
         ];
     }

     public function account(){
        return $this->belongsTo(Account::class);
     }
 
     public function entity(){
         return $this->belongsTo(Entity::class, 'entity_id'); 
     }
 
     public function category(){
         return $this->belongsTo(Category::class, 'category_id'); 
     }
    
    public function subEntity(){
        return $this->belongsTo(SubEntity::class, 'sub_entity_id');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id'); 
    }
}
