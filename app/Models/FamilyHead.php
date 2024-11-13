<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHead extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'birthdate', 'mobile_no', 'address', 'state_id', 'city_id', 'pincode', 'marital_status', 'wedding_date', 'hobbies', 'photo'];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }
}
