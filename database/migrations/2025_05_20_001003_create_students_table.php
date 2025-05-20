// database/migrations/xxxx_xx_xx_create_students_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('age')->nullable();
            $table->tinyInteger('age_of_adoption')->default(0);
            $table->longText('allergies')->nullable();
            $table->boolean('allergy')->nullable();
            $table->longText('allergyreaction')->nullable();
            $table->date('application')->nullable();
            $table->boolean('asthma')->nullable();
            $table->boolean('asthmainhaler')->nullable();
            $table->longText('authorized_person_to_fetch')->nullable();
            $table->string('barangay');
            $table->string('billing_email')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('city_municipality');
            $table->string('contactnumber')->nullable();
            $table->string('contactnumberCountryCode')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('studentnumber')->unique()->nullable();
            $table->boolean('isTempStudentNumber')->default(false);
            // Add all other fields here...

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
