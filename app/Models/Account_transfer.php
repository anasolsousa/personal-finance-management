<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Account;
use App\Models\Category;

class Account_transfer extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'destination_account_id',
        'transfer_id',
        'user_id',
    ];

    public function transfer(){
        return $this->belongsTo(Transfer::class);
    }
    
    public function account_from(){
        return $this->belongsTo(Account::class, 'id', 'account_from_id');
    }
    
    public function account_to(){
        return $this->belongsTo(Account::class, 'id', 'account_to_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
