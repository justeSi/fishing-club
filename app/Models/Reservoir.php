<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Member;

class Reservoir extends Model
{
    use HasFactory;
    public function getMembers()
    {
        return $this->hasMany(Member::class, 'reservoir_id', 'id');
    }

}
