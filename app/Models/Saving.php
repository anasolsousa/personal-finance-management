<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Transfer;

class Saving extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'reinforcement',
        'end_date',
        'transfer_id',
        'entity_id',
        'category_id',
    ];
    
    public function transfer() {
        return $this->belongsTo(Transfer::class);
    }

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
