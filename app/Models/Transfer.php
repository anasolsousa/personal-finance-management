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
        'user_id',
        'date',
        'notes',
        'amount',
        'type',
        'account_from_id',

        'entity_id',
        'sub_entity_id',
        'category_id',
        'sub_category_id',
        
        'account_to_id',
        'initial_amount',
        'final_amount',
        'reinforcement',
        'end_date',
    ];

    public static function Types()
    {
        return [
            'account_transfer',
            'saving',
            'investment',
        ];
    }

    public function accountFrom()
    {
        return $this->belongsTo(Account::class, 'account_from_id');
    }

    public function accountTo()
    {
        return $this->belongsTo(Account::class, 'account_to_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function investment()
    {
        return $this->hasOne(Investment::class);
    }

    public function saving()
    {
        return $this->hasOne(Saving::class);
    }

    public function accountTransfer()
    {
        return $this->hasOne(AccountTransfer::class);
    }
}
