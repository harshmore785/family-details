<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['family_head_id', 'name', 'birthdate', 'marital_status', 'wedding_date', 'education', 'photo'];

    // app/Models/FamilyMember.php
    public function familyHead()
    {
        return $this->belongsTo(FamilyHead::class);
    }

}
