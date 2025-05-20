<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $table = 'students';

    protected $guarded = []; // Allow mass assignment on all columns

    protected $casts = [
        'application' => 'date',
        'birthdate' => 'date',
        'date' => 'date',
        'date2' => 'date',
        'isTempStudentNumber' => 'boolean',
        'is_transferee' => 'boolean',
        'remedialhelp' => 'boolean',
        'otherinfo' => 'boolean',
        'disciplinaryproblem' => 'boolean',
        'fatherreceivetext' => 'boolean',
        'motherreceivetext' => 'boolean',
        'is_child_adopted' => 'boolean',
        'is_child_know_adopted' => 'boolean',
        'is_stepmother' => 'boolean',
        'is_stepfather' => 'boolean',
        'stepmother_years' => 'boolean',
        'firstaidd' => 'boolean',
        'emergencycare' => 'boolean',
        'hospitalemergencycare' => 'boolean',
        'oralmedication' => 'boolean',
        'corrective_eyeglasses' => 'boolean',
        'hearing_aid' => 'boolean',
        'asthma' => 'boolean',
        'asthmainhaler' => 'boolean',
        'allergy' => 'boolean',
        'drugallergy' => 'boolean',
        'visionproblem' => 'boolean',
        'hearingproblem' => 'boolean',
        'hashealthcondition' => 'boolean',
        'ishospitalized' => 'boolean',
        'hadinjuries' => 'boolean',
        'medication' => 'boolean',
        'schoolhourmedication' => 'boolean',
        'isagree' => 'boolean',
        'formiscorrect' => 'boolean',
        'past_accidents' => 'boolean',
    ];

    // You can also define relationships here like:
    // public function department() {
    //     return $this->belongsTo(Department::class);
    // }
}
