<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Expense;
use App\Models\User;

class Account extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transfersFrom()
    {
        return $this->hasMany(Transfer::class, 'account_from_id');
    }

    public function transfersTo()
    {
        return $this->hasMany(Transfer::class, 'account_to_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
