<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = [
        'qbo_customer_id',
        'studentnumber',
        'lrn',
        'application',
        'schoolyear',
        'department_id',
        'level_id',
        'track_id',
        'track_description',
        'course_id',
        'new_or_old',
        'photo',
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'birthdate',
        'age',
        'citizenship',
        'birthplace',
        'residentialaddress',
        'street_number',
        'barangay',
        'city_municipality',
        'province',
        'email',
        'isTempStudentNumber',
    ];
}
