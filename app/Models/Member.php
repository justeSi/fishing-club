<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Reservoir;

class Member extends Model
{
    use HasFactory;
    
public function getReservoir()
    {
        return $this->belongsTo(Reservoir::class, 'reservoir_id', 'id');
    }

}
