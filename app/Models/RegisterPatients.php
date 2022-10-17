<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterPatients extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-d-m H:i:s';
    protected $table = "RegisterPatients";
    protected $fillable = [
        'document_type', 'document', 'names', 'gender', 'ethnicity', 'mother_tongue', 'birth_date', 'age', 'younger', 'clinic_history',
        'pn_registration_date', 'case_type', 'cellphone', 'pseudonym_code', 'sure_type', 'category', 'region_register', 'province_register',
        'district_register', 'establishment_register', 'region_before',
        'province_before', 'district_before', 'direction_before', 'region_current', 'province_current', 'district_current',
        'direction_current', 'age_current', 'document_type_authorized', 'document_authorized', 'names_authorized', 'cellphone_authorized',
        'intoxication_type', 'covid_vaccination', 'state'
    ];
}

