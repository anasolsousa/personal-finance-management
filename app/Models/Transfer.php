<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Account;

class Transfer extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'date',
        'notes',
        'amount',
        'type',
        'account_from_id',
    ];

     public static function Types()
     {
         return [
             'account_transfer',
             'saving',
             'investment',
         ];
     }

     public function accountFrom(){
         return $this->belongsTo(Account::class, 'account_from_id');
     }
 
     public function accountTo(){
         return $this->belongsTo(Account::class, 'account_to_id');
     }
 
     public function investments(){
         return $this->hasMany(Investment::class);
     }
}
