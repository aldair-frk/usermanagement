<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    // protected $dateFormat = 'Y-d-m H:i:s';
    protected $table = "Person";
    protected $fillable = [
        'dni', 'last_name0', 'last_name1', 'names', 'birth_date', 'gender', 'address', 'phone', 'institute', 'is_region',
        'is_province', 'is_district'
    ];
}
