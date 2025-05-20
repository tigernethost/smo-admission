<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qbo_customer_id')->nullable();
            $table->bigInteger('studentnumber')->unique()->nullable();
            $table->boolean('isTempStudentNumber')->default(false);
            $table->string('lrn')->nullable()->default('0000000');
            $table->date('application')->nullable();
            $table->string('schoolyear')->nullable();
            $table->integer('department_id');
            $table->string('level_id')->nullable();
            $table->integer('track_id')->nullable();
            $table->integer('track_description')->nullable();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->string('new_or_old');
            $table->longText('photo')->nullable(); //notsure
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthdate')->nullable();
            $table->integer('age');
            $table->string('citizenship')->nullable();
            //$table->string('passport')->nullable();
            $table->string('birthplace')->nullable();
            $table->longText('residentialaddress')->nullable();
            $table->string('street_number');
            $table->string('barangay');
            $table->string('city_municipality');
            $table->string('province');
            $table->string('email')->nullable();
            $table->string('religion')->nullable();
            $table->longText('living')->nullable();
            $table->string('other_relative')->nullable();
            $table->string('legalguardian')->nullable();
            $table->string('legal_guardian_lastname')->nullable();
            $table->string('legal_guardian_firstname')->nullable();
            $table->string('legal_guardian_middlename')->nullable();
            $table->string('legal_guardian_citizenship')->nullable();
            $table->string('legal_guardian_occupation')->nullable();
            $table->string('legal_guardian_contact_number_country_code')->nullable();
            $table->string('legal_guardian_contact_number')->nullable();
            $table->string('legal_guardian_email')->nullable();
            $table->string('contactnumberCountryCode')->nullable();
            $table->string('contactnumber')->nullable();
            $table->enum('readingwriting', ['Good', 'Fair', 'Limited', 'None']);
            $table->enum('verbalproficiency', ['Good', 'Fair', 'Limited', 'None']);
            $table->longText('majorlanguages')->nullable();
            $table->longText('other_language_specify')->nullable();
            $table->longText('otherlanguages')->nullable();
            $table->longText('classparticipation')->nullable();
            $table->boolean('remedialhelp')->nullable();
            $table->longText('remedialhelpexplanation')->nullable();
            $table->longText('specialtalent')->nullable(); //remove nullable ----testss
            //$table->string('athletics')->nullable(); //may not be needed
            //$table->string('band')->nullable();//may not be needed
            //$table->string('string')->nullable();//may not be needed
            $table->boolean('otherinfo')->nullable();
            $table->longText('otherinfofield')->nullable(); //new field
            $table->boolean('disciplinaryproblem')->nullable(); //may not be needed
            $table->longText('disciplinaryproblemexplanation')->nullable();
            //-----------------
            $table->longText('previousschool')->nullable();
            $table->string('inclusive_date')->nullable();
            $table->boolean('is_transferee')->default(false);
            $table->longText('previousschooladdress')->nullable();
            $table->longText('schooltable')->nullable();
            $table->longText('organizations')->nullable();
            //------------------------------------------------------------------
            $table->enum('father', ['Father', 'Step-father', 'Legal Guardian'])->nullable();
            $table->enum('father_living_deceased', ['living', 'deceased']);
            $table->string('fatherfirstname')->nullable();
            $table->string('fatherlastname')->nullable();
            $table->string('fathermiddlename')->nullable();
            $table->string('fathercitizenship')->nullable();
            $table->string('father_occupation')->nullable();
            //$table->string('fatherpassport')->nullable();//may mot be needed // ----not needed
            $table->string('fathervisastatus')->nullable();
            $table->longText('fatheremployer')->nullable();
            $table->string('fatherofficenumberCountryCode')->nullable();
            $table->string('fatherofficenumber')->nullable();
            $table->longText('fatherdegree')->nullable();
            $table->longText('fatherschool')->nullable();
            $table->string('fatherMobileNumberCountryCode')->nullable();
            $table->string('fatherMobileNumber')->nullable();
            $table->string('father_email')->nullable();
            $table->boolean('fatherreceivetext')->nullable();
            //-------------------------------------------------------------------
            $table->enum('mother', ['Mother', 'Step-mother', 'Legal Guardian']);
            $table->enum('mother_living_deceased', ['living', 'deceased']);
            $table->string('motherfirstname')->nullable();
            $table->string('motherlastname')->nullable();
            $table->string('mothermiddlename')->nullable();
            $table->string('mothercitizenship')->nullable();
            $table->string('mother_occupation')->nullable();
            //$table->string('motherpassport')->nullable(); //may mot be needed // ----not needed
            $table->string('mothervisastatus')->nullable();
            $table->longText('motheremployer')->nullable();
            $table->string('motherOfficeNumberCountryCode')->nullable();
            $table->string('motherOfficeNumber')->nullable();
            $table->longText('motherdegree')->nullable();
            $table->longText('motherschool')->nullable();
            $table->string('mothernumberCountryCode')->nullable();
            $table->string('mothernumber')->nullable();
            $table->string('mother_email')->nullable();
            $table->boolean('motherreceivetext')->nullable();
            $table->string('parents_marital_status')->nullable();
            $table->boolean('is_child_adopted')->default(0);
            $table->boolean('age_of_adoption')->default(0);
            $table->boolean('is_child_know_adopted')->nullable()->default(0);
            $table->boolean('is_stepmother')->default(0);
            $table->boolean('is_stepfather')->default(0);
            $table->boolean('stepfather_years')->nullable();
            $table->string('billing_email')->nullable();
            $table->longText('siblings')->nullable();
            $table->longText('relatives')->nullable();
            $table->longText('authorized_person_to_fetch')->nullable();
            $table->boolean('stepmother_years')->nullable();
            //------------------------------------------------------------------

            $table->longText('emergencycontactname')->nullable();
            $table->string('emergency_contact_other_relation_ship_to_child')->nullable();
            $table->string('emergency_lastname')->nullable();
            $table->string('emergency_firstname')->nullable();
            $table->string('emergency_middlename')->nullable();
            $table->string('emergency_citizenship')->nullable();
            $table->longText('emergencyRelationshipToChild')->nullable();
            $table->string('emergencyofficephoneCountryCode')->nullable();
            $table->string('emergencyofficephone')->nullable();
            $table->string('emergencymobilenumberCountryCode')->nullable();
            $table->string('emergencymobilenumber')->nullable();
            $table->longText('emergencyaddress')->nullable();
            $table->string('emergencyhomephoneCountryCode')->nullable();
            $table->string('emergencyhomephone')->nullable();

            $table->boolean('isagree')->nullable();//not sure
            $table->boolean('formiscorrect')->nullable();//not sure

            $table->longText('fathersignature')->nullable();
            $table->longText('mothersignature')->nullable();
            $table->date('date')->nullable();
            //------------------3rd page
            $table->longText('past_illness')->nullable();
            $table->boolean('past_accidents')->default(0);
            $table->longText('past_accidents_description')->nullable();
            $table->longText('frequent_sickness')->nullable();
            $table->boolean('asthma')->nullable();
            $table->boolean('asthmainhaler')->nullable();
            $table->boolean('allergy')->nullable();
            $table->longText('allergies')->nullable();
            $table->longText('allergyreaction')->nullable();
            $table->boolean('drugallergy')->nullable();
            $table->longText('drugallergies')->nullable();
            $table->longText('drugallergyreaction')->nullable();
            $table->boolean('visionproblem')->nullable();
            $table->longText('visionproblemdescription')->nullable();
            $table->boolean('corrective_eyeglasses')->default(0);
            $table->boolean('hearingproblem')->nullable();
            $table->longText('hearingproblemdescription')->nullable();
            $table->boolean('hearing_aid')->default(0);
            $table->boolean('hashealthcondition')->nullable();
            $table->longText('healthcondition')->nullable();
            $table->boolean('ishospitalized')->nullable();
            $table->longText('hospitalized')->nullable();
            $table->boolean('hadinjuries')->nullable();
            $table->longText('injuries')->nullable();
            $table->boolean('medication')->nullable();
            $table->longText('medications')->nullable();
            $table->boolean('schoolhourmedication')->nullable();
            //---------------------
            $table->boolean('firstaidd')->nullable();
            $table->boolean('emergencycare')->nullable();
            $table->boolean('hospitalemergencycare')->nullable();
            $table->boolean('oralmedication')->nullable();
            $table->longText('parentsignature')->nullable();
            $table->date('date2')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
