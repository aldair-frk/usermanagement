<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterAttentions extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-d-m H:i:s';
    protected $table = "RegisterAttentions";
    protected $fillable = [
        'document', 'year_a', 'month_a', 'solicitude_medic', 'reference', 'reference_place', 'integral_attention', 'specialized_attention',
        'specialized_attention_detail', 'clinic_history',
        'medicine_attention', 'nursing_attention', 'obstetrics_attention', 'psychology_attention', 'telemedicine_attention', 'pb_attention',
        'as_attention', 'cd_attention', 'odontology_attention', 'cred_attention', 'link_attention', 'against_reference', 'against_reference_place',
        'hg_attention', 'other_attention', 'hemoglobin', 'urine', 'liver_profile', 'hematocrit',
        'lipidic_profile', 'type_intervention', 'ipress_attention', 'service_attention', 'date_attention', 'results_attention',
        'observations_attention', 'patient_id'
    ];
}
