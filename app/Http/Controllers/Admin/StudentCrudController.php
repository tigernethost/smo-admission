<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https: //backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb();  // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https: //backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);
        // CRUD::setFromDb(); // set fields from db columns.
        $this->setStudentInformationFields();
        $this->setHealthInformationFields();
        $this->setNotificationFields();
        //----------------------------------------------------------------------------------
        // Checklist
        // Past Illnesses
    }
    public function setStudentInformationFields()
    {
        // Student Information
        CRUD::addField([
            'name' => 'new_or_old',
            'label' => 'Status',
            'type' => 'select_from_array',
            'options' => [
                'New Student' => 'New Student',
                'Old Student' => 'Old Student',
            ],
            'allows_null' => false,
            'default' => 'New Student',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);

        CRUD::addField([
            'name' => 'schoolyear',
            'label' => 'School Year Entered',
            'type' => 'select_from_array',
            'options' => [
                'YEAR' => 'YEAR',
            ],
            'allows_null' => false,
            'attributes' => ['required' => 'required'],
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3 required'],
        ]);

        CRUD::addField([
            'name' => 'application',
            'label' => 'Application Date',
            'type' => 'date_picker',
            'tab' => 'Student Information',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-3 required'],
            'default' => now()->toDateString(),
        ]);
        /////
        CRUD::addField([
            'name' => 'div1',
            'type' => 'custom_html',
            'value' => '<div class="form-group col-xs-12 mb-0 p-0"></div>',
            'tab' => 'Student Information',
        ]);
        /////
        CRUD::addField([
            'name' => 'department_id',
            'label' => 'Department',
            'type' => 'select_from_array',
            'options' => [
                1 => 'College of Arts',
                2 => 'College of Science',
                3 => 'College of Engineering',
            ],
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
            'allows_null' => false,
            'default' => 1,
        ]);

        CRUD::addField([
            'name' => 'level_id',
            'label' => 'Level',
            'type' => 'select_from_array',
            'options' => [
                1 => '1',
                2 => '2',
                3 => '3',
            ],
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
            'allows_null' => false,
            'default' => 1,
        ]);

        CRUD::addField([
            'name' => 'photo',
            'label' => 'Photo',
            'type' => 'image',
            'tab' => 'Student Information',
            'crop' => true,
            'aspect_ratio' => 1,
        ]);

        CRUD::addField([
            'name' => 'studentnumber',
            'label' => 'Student Number',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['readonly' => 'true'],
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);

        CRUD::addField([
            'name' => 'lrn',
            'label' => 'LRN',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);

        /////
        CRUD::addField([
            'name' => 'div2',
            'type' => 'custom_html',
            'value' => '<div class="form-group col-xs-12 mb-0 p-0"></div>',
            'tab' => 'Student Information',
        ]);
        /////

        CRUD::addField([
            'name' => 'last_name',
            'label' => 'Last Name',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-3 required'],
        ]);
        CRUD::addField([
            'name' => 'first_name',
            'label' => 'First Name',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-3 required'],
        ]);
        CRUD::addField([
            'name' => 'middle_name',
            'label' => 'Middle Name',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);

        CRUD::addField([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'select_from_array',
            'options' => ['Male' => 'Male', 'Female' => 'Female'],
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);

        /////
        CRUD::addField([
            'name' => 'div3',
            'type' => 'custom_html',
            'value' => '<div class="form-group col-xs-12 mb-0 p-0"></div>',
            'tab' => 'Student Information',
        ]);
        /////

        CRUD::addField([
            'name' => 'citizenship',
            'label' => 'Citizenship',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'religion',
            'label' => 'Religion',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'contactnumber',
            'label' => 'Contact Number',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'birthplace',
            'label' => 'Place of Birth',
            'type' => 'text',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'birthdate',
            'label' => 'Date of Birth',
            'type' => 'date_picker',
            'tab' => 'Student Information',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        CRUD::addField([
            'name' => 'age',
            'label' => 'Age',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['readonly' => 'true'],
            'wrapper' => ['class' => 'form-group col-md-1'],
        ]);

        /////
        CRUD::addField([
            'name' => 'div4',
            'type' => 'custom_html',
            'value' => '<div class="form-group col-xs-12 mb-0 p-0">Residential Address In The Philippines</div>',
            'tab' => 'Student Information',
        ]);
        /////

        CRUD::addField([
            'name' => 'province',
            'label' => 'Province',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => true],
            'wrapper' => ['class' => 'form-group col-md-2 required'],
        ]);
        CRUD::addField([
            'name' => 'city_municipality',
            'label' => 'City/Municipality',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => true],
            'wrapper' => ['class' => 'form-group col-md-2 required'],
        ]);
        CRUD::addField([
            'name' => 'barangay',
            'label' => 'Barangay',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => true],
            'wrapper' => ['class' => 'form-group col-md-2 required'],
        ]);
        CRUD::addField([
            'name' => 'barangay',
            'label' => 'Barangay',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => true],
            'wrapper' => ['class' => 'form-group col-md-2 required'],
        ]);
        CRUD::addField([
            'name' => 'residentialaddress',
            'label' => '',
            'type' => 'text',
            'tab' => 'Student Information',
            'attributes' => ['required' => true, 'placeholder' => 'Address',],
            'wrapper' => ['class' => 'form-group col-md-6 required'],
        ]);
    }
    public function setFamilyBackgroundFields()
    {

    }
    public function setHealthInformationFields()
    {
        CRUD::addField([
            'name' => 'past_illnesses',
            'label' => 'What illness has child had?',
            'type' => 'checklist_illness',
            'options' => [
                'chicken_pox' => 'Chicken Pox',
                'dengue' => 'Dengue',
                'mumps' => 'Mumps',
                'hepatitis' => 'Hepatitis',
                'measles' => 'Measles',
                'others' => 'Others',
            ],
            'tab' => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // Frequent Symptoms
        CRUD::addField([
            'name' => 'frequent_symptoms',
            'label' => 'Does child have frequent',
            'type' => 'checklist_illness',
            'options' => [
                'colds' => 'Colds',
                'cough' => 'Cough',
                'tonsillitis' => 'Tonsillitis',
                'fever' => 'Fever',
                'influenza' => 'Influenza',
                'stomaches' => 'Stomaches',
                'others' => 'Others',
            ],
            'tab' => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // Yes or No
        CRUD::addField([
            'name' => 'past_accidents',
            'label' => 'Has child had any various accidents?',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'ishospitalized',
            'label' => 'Does the child have been hospitalized?',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'allergy',
            'label' => 'Is the child allergic?',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'asthma',
            'label' => 'Asthma',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'drugallergy',
            'label' => 'Drug Allergy',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'visionproblem',
            'label' => 'Eye or vision problems',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'hearingproblem',
            'label' => 'Ear or hearing problems',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'hashealthcondition',
            'label' => 'Any other health condition that the school should be aware of (e.g epilepsy, diabetes, etc.)',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'medication',
            'label' => 'Is the child on a regular medication?',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'schoolhourmedication',
            'label' => 'Does child need to take any medication(s) during school hours?',
            'type' => 'radio',
            'options' => [
                1 => 'Yes (if yes, a letter from the Medical Doctor must be submitted and be kept on file and medication(s) will also be kept in school, to be dispensed only by teacher or authorized person.)',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'consent_intro',
            'type' => 'custom_html',
            'value' => '<strong>The parent gave consent for the child to receive the following:</strong>',
            'tab' => 'Health Information',
            'wrapper' => ['class' => 'col-12 mb-3'],
        ]);

        CRUD::addField([
            'name' => 'firstaidd',
            'label' => '1. Minor first aid',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'emergencycare',
            'label' => '2. Emergency care',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'hospitalemergencycare',
            'label' => '3. Emergency care at the nearest hospital',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name' => 'oralmedication',
            'label' => '4. Oral non-prescription medication',
            'type' => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);
    }
    public function setNotificationFields()
    {
        // Notifications
        CRUD::addField([
            'name' => 'father_email',
            'label' => 'Father Email',
            'type' => 'email',
            'tab' => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'mother_email',
            'label' => 'Mother Email',
            'type' => 'email',
            'tab' => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'legal_guardian_email',
            'label' => 'Legal Guardian Email',
            'type' => 'email',
            'tab' => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'emergency_email',
            'label' => 'Emergency Email',
            'type' => 'email',
            'tab' => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'billing_email',
            'label' => 'Billing Email',
            'type' => 'email',
            'tab' => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
    }
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https: //backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function rules()
    {
        return [
            'schoolyear' => 'required|string|max:255',
            // other rules...
        ];
    }
}
