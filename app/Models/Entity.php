<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Transaction;
use App\Models\SubEntity;

class Entity extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'name',
        'icon',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function subEntities(){
        return $this->hasMany(SubEntity::class, 'entity_id');
    }
}
