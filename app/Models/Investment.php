<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Account;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Transfer;

class Investment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'initial_amount',
        'final_amount',
        'reinforcement',
        'transfer_id',
        'user_id',
    ];

    public function transfer(){
        return $this->belongsTo(Transfer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
