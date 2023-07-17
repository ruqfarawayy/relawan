<?php

namespace App\Models;

use App\Http\Controllers\SpecialtyController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Volunteer extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nra','name', 'email', 'phone', 'address', 'occupation_id', 'education_id', 'blood_type', 'gender', 'birth_date', 'unit_id', 'volunteer_type_id', 'status', 'photo'
    ];

  public function specialties(){
    return $this->belongsToMany(Specialty::class, 'volunteer_specialty', 'volunteer_id' );
  }

  public function occupations(){
    return $this->belongsTo(Occupation::class, 'occupation_id', 'id' );
  }
  public function education(){
    return $this->belongsTo(Education::class, 'education_id', 'id' );
  }
  public function volunteerType(){
    return $this->belongsTo(VolunteerType::class, 'volunteer_type_id', 'id' );
  }
  public function unit(){
    return $this->belongsTo(Unit::class, 'unit_id','id' );
  }
}
