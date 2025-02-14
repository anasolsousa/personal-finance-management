<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Entity;

class SubEntity extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'name',
        'entity_id'
    ];

    public function entity(){
        return $this->belongsTo(Entity::class, 'entity_id');
    }
    
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
