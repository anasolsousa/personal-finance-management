<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    
    use Notifiable;
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

     // Relação com Accounts (1 user tem muitas contas)
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    // Relação com Transfers (1 user tem muitas transfers)
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    // Relação com Transactions (1 user tem muitas transactions)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relação com Investments (1 user tem muitos investments)
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    // Relação com Savings (1 user tem muitos savings)
    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    // Relação com AccountTransfers (1 user tem muitos account_transfers)
    public function accountTransfers()
    {
        return $this->hasMany(AccountTransfer::class);
    }
    
}
