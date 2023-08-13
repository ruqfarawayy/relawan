<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'coach', 'address' ,  'user_id', 'birth_date'
    ];


}
