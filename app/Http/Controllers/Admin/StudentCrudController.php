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
        $this->setFamilyBackgroundFields();
        $this->setScholasticInformationFields();
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
            'wrapper' => ['class' => 'm-0 p-0'],
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
            'wrapper' => ['class' => 'm-0 p-0'],
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
            'wrapper' => ['class' => 'm-0 p-0'],
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
            'wrapper' => ['class' => 'm-0 p-0'],
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
        CRUD::addField([
            'name' => 'father',
            'label' => 'Parent',
            'type' => 'select_from_array',
            'options' => [
                'Father',
                'Step-father',
                'Legal Guardian'
            ],
            'tab' => 'Family Background',
            'allows_null' => false,
            'wrapper' => ['class' => 'form-group col-md-5'],
        ]);
        CRUD::addField([   // radio
            'name' => 'father_living_deceased', // the name of the db column
            'label' => '', // the input label
            'type' => 'radio',
            'options' => [
                // the key will be stored in the db, the value will be shown as label;
                0 => "Living",
                1 => "Deceased"
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-5 pt-4'],
            'inline' => true, // show the radios all on the same line?
            'default' => 0
        ]);
        CRUD::addField([
            'name' => 'fatherlastname',
            'label' => 'Last Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'fatherfirstname',
            'label' => 'First Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'fathermiddlename',
            'label' => 'Middle Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'fathercitizenship',
            'label' => 'Citizenship',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'fathervisastatus',
            'label' => 'Philippine Visa Status',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([   // phone
            'name' => 'phone', // db column for phone
            'label' => 'Mobile Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([
            'name' => 'father_occupation',
            'label' => 'Father Occupation',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'fatheremployer',
            'label' => 'Employer/Organization',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([   // phone
            'name' => 'fatherofficenumber', // db column for phone
            'label' => 'Office Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([
            'name' => 'fatherdegree',
            'label' => 'Graduate Degree',
            'type' => 'textarea',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        CRUD::addField([
            'name' => 'fatherschool',
            'label' => 'School',
            'type' => 'textarea',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        CRUD::addField([
            'name' => 'mother',
            'label' => 'Parent',
            'type' => 'select_from_array',
            'options' => [
                'Mother',
                'Step-Mother',
                'Legal Guardian'
            ],
            'tab' => 'Family Background',
            'allows_null' => false,
            'wrapper' => ['class' => 'form-group col-md-5'],
        ]);
        CRUD::addField([   // radio
            'name' => 'mother_living_deceased', // the name of the db column
            'label' => '', // the input label
            'type' => 'radio',
            'options' => [
                // the key will be stored in the db, the value will be shown as label;
                0 => "Living",
                1 => "Deceased"
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-5 pt-4'],
            'inline' => true, // show the radios all on the same line?
            'default' => 0
        ]);
        CRUD::addField([
            'name' => 'motherlastname',
            'label' => 'Last Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'motherfirstname',
            'label' => 'First Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'mothermiddlename',
            'label' => 'Middle Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'mothercitizenship',
            'label' => 'Citizenship',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'mothervisastatus',
            'label' => 'Philippine Visa Status',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([   // phone
            'name' => 'mothernumber', // db column for phone
            'label' => 'Mobile Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([
            'name' => 'mother_occupation',
            'label' => 'mother Occupation',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'motheremployer',
            'label' => 'Employer/Organization',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([   // phone
            'name' => 'motherofficenumber', // db column for phone
            'label' => 'Office Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([
            'name' => 'motherdegree',
            'label' => 'Graduate Degree',
            'type' => 'textarea',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        CRUD::addField([
            'name' => 'motherschool',
            'label' => 'School',
            'type' => 'textarea',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        CRUD::addField([   // radio
            'name' => 'parents_marital_status', // the name of the db column
            'label' => 'Marital Status of Parents:', // the input label
            'type' => 'radio',
            'options' => [
                0 => 'Married',
                1 => 'Widowed',
                2 => 'Solo Parent',
                3 => 'Separated',
                4 => 'Live-in',
                5 => 'Annulled/Divorced'
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group'],
            'inline' => true, // show the radios all on the same line?
            'default' => 0
        ]);
        CRUD::addField([   // radio
            'name' => 'is_child_adopted', // the name of the db column
            'label' => 'Is child adopted?', // the input label
            'type' => 'radio',
            'options' => [
                0 => 'Yes',
                1 => 'No',
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group'],
            // 'inline' => true, // show the radios all on the same line?
            'default' => 1
        ]);

        CRUD::addField([
            'name' => 'siblings',
            'label' => 'Siblings',
            'type' => 'table',
            'entity_singular' => 'sibling',
            'columns' => [
                'name' => 'Name',
                'dob' => 'Date of Birth',
                'education' => 'Educational Attainment',
            ],
            'min' => 1, // optional
            'tab' => 'Family Background',
        ]);
        CRUD::addField([
            'name' => 'relatives',
            'label' => 'Relatives/household members living with the family',
            'type' => 'table',
            'entity_singular' => 'relative',
            'columns' => [
                'name' => 'Name',
                'dob' => 'Date of Birth',
                'education' => 'Educational Attainment',
            ],
            'min' => 1, // optional
            'max' => 10, // optional
            'tab' => 'Family Background',
        ]);


        /////
        CRUD::addField([
            'name' => 'div5',
            'type' => 'custom_html',
            'value' => '<div class=""><h1>LEGAL GUARDIAN INFORMATION</h1></div>',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-xs-12 m-0 p-0'],
        ]);
        /////

        CRUD::addField([
            'name' => 'legal_guardian_lastname',
            'label' => 'Last Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'legal_guardian_firstname',
            'label' => 'First Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'legal_guardian_middlename',
            'label' => 'Middle Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'legal_guardian_citizenship',
            'label' => 'Citizenship',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([
            'name' => 'legal_guardian_visastatus',
            'label' => 'Philippine Visa Status',
            'type' => 'text',
            'tab' => 'Family Background',
            'attributes' => ['required' => 'required'],
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        CRUD::addField([   // phone
            'name' => 'legal_guardian_contact_number', // db column for phone
            'label' => 'Mobile Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);

        /////
        CRUD::addField([
            'name' => 'div6',
            'type' => 'custom_html',
            'value' => '<div class=""><h1>EMERGENCY CONTACT INFORMATION</h1></div>',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-xs-12 m-0 p-0'],
        ]);
        /////

        CRUD::addField([
            'name' => 'emergencyRelationshipToChild',
            'label' => 'Relationship To Child',
            'type' => 'select_from_array',
            'options' => [
                'Father',
                'Mother',
                'LegalGuardian',
                'Other',
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        /////
        CRUD::addField([
            'name' => 'div8',
            'type' => 'custom_html',
            'value' => '<div class=""></div>',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-xs-12 m-0 p-0'],
        ]);
        /////

        CRUD::addField([
            'name' => 'emergency_firstname',
            'label' => 'First Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            'conditional_logic' => [
                [
                    'when' => 'emergencyRelationshipToChild',
                    'operator' => '=',
                    'value' => 'Other',
                ],
            ],
        ]);
        CRUD::addField([
            'name' => 'emergency_middlename',
            'label' => 'Middle Name',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            'conditional_logic' => [
                [
                    'when' => 'emergencyRelationshipToChild',
                    'operator' => '=',
                    'value' => 'Other',
                ],
            ],
        ]);
        CRUD::addField([
            'name' => 'emergencyaddress',
            'label' => 'Address',
            'type' => 'text',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            'conditional_logic' => [
                [
                    'when' => 'emergencyRelationshipToChild',
                    'operator' => '=',
                    'value' => 'Other',
                ],
            ],
        ]);
        CRUD::addField([   // phone
            'name' => 'emergencymobilenumber', // db column for phone
            'label' => 'Mobile Number',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([   // phone
            'name' => 'emergencyhomephone', // db column for phone
            'label' => 'Home Phone',
            'type' => 'phone',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
            // OPTIONALS
            // most options provided by intlTelInput.js are supported, you can try them out using the `config` attribute;
            //  take note that options defined in `config` will override any default values from the field;
            'config' => [
                'initialCountry' => 'ph', // this needs to be in the allowed country list, either in `onlyCountries` or NOT in `excludeCountries`
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'none',
                'placeholder' => '',
            ]
        ]);
        CRUD::addField([
            'name' => 'show_if_other_script',
            'type' => 'custom_html',
            'value' => '
        <script>
        setTimeout(()=>{
            crud.field("emergencyRelationshipToChild").onChange(function(field) {
                crud.field("emergency_firstname").show(field.value === "3");
                crud.field("emergency_middlename").show(field.value === "3");
                crud.field("emergencymobilenumber").show(field.value === "3");
            }).change(); // trigger on page load
        },500)
        </script>
    ',
            'tab' => 'Family Background',
        ]);
        /////
        CRUD::addField([
            'name' => 'div7',
            'type' => 'custom_html',
            'value' => '<div class=""><h1>PERSON AUTHORIZED TO FETCH THE CHILD</h1></div>',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-xs-12 m-0 p-0'],
        ]);
        /////

        CRUD::addField([
            'name' => 'authorized_person_to_fetch',
            'label' => 'Authorized Person to Fetch',
            'type' => 'table',
            'entity_singular' => 'person',
            'columns' => [
                'name' => 'Name',
                'relationship' => 'Relationship',
            ],
            'min' => 1, // optional: minimum rows
            'tab' => 'Family Background',
        ]);

        /////
        CRUD::addField([
            'name' => 'div9',
            'type' => 'custom_html',
            'value' => '<div class=""><h3>Living</h3></div>',
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-xs-12 m-0 p-0'],
        ]);
        /////
        CRUD::addField([
            'name' => 'living',
            'label' => 'The student will be living in the Philippines with (pls. check all that apply) *',
            'type' => 'checklist_illness',
            'options' => [
                'Father',
                'Mother',
                'Step-Father',
                'Step-Mother',
                'Legal Guardian',
            ],
            'tab' => 'Family Background',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
    }
    //Health Information Fields
    public function setHealthInformationFields()
    {
        // Past Illnesses
        CRUD::addField([
            'name'  => 'other_past_illnesses_script',
            'type'  => 'custom_html',
            'value' => '<script>
            function togglePastIllnessesOtherInput() {
                const illnessCheckboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                const otherInput = document.getElementById("past_illnesses_others");

                let checkedValues = Array.from(illnessCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const selectedThreeOrMore = checkedValues.length >= 3;
                const selectedOthers = checkedValues.includes("others");

                if (selectedThreeOrMore || selectedOthers) {
                    otherInput.disabled = false;
                    otherInput.style.cursor = "text";
                } else {
                    otherInput.disabled = true;
                    otherInput.style.cursor = "not-allowed";
                    otherInput.value = "";
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                togglePastIllnessesOtherInput();
                const illnessCheckboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                illnessCheckboxes.forEach(cb => cb.addEventListener("change", togglePastIllnessesOtherInput));
            });
            </script>',
            'tab' => 'Health Information',
        ]);

        CRUD::addField([
            'name'  => 'other_frequent_symptoms_script',
            'type'  => 'custom_html',
            'value' => '<script>
            function toggleFrequentSymptomsOtherInput() {
                const FrequentSymptomsCheckboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                const otherInput = document.getElementById("frequent_sickness_others");

                let checkedValues = Array.from(FrequentSymptomsCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const selectedThreeOrMore = checkedValues.length >= 3;
                const selectedOthers = checkedValues.includes("others");

                if (selectedThreeOrMore || selectedOthers) {
                    otherInput.disabled = false;
                    otherInput.style.cursor = "text";
                } else {
                    otherInput.disabled = true;
                    otherInput.style.cursor = "not-allowed";
                    otherInput.value = "";
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                toggleFrequentSymptomsOtherInput();
                const illnessCheckboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                illnessCheckboxes.forEach(cb => cb.addEventListener("change", toggleFrequentSymptomsOtherInput));
            });
            </script>',
            'tab' => 'Health Information',
        ]);

        CRUD::addField([
            'name'    => 'past_illnesses',
            'label'   => 'What illness has child had?',
            'type'    => 'checklist_illness',
            'options' => [
                'chicken_pox' => 'Chicken Pox',
                'dengue'      => 'Dengue',
                'mumps'       => 'Mumps',
                'hepatitis'   => 'Hepatitis',
                'measles'     => 'Measles',
                'others'      => 'Others',
            ],
            'tab'     => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // Frequent Symptoms
        CRUD::addField([
            'name'    => 'frequent_symptoms',
            'label'   => 'Does child have frequent',
            'type'    => 'checklist_illness',
            'options' => [
                'colds'       => 'Colds',
                'cough'       => 'Cough',
                'tonsillitis' => 'Tonsillitis',
                'fever'       => 'Fever',
                'influenza'   => 'Influenza',
                'stomaches'   => 'Stomaches',
                'others'      => 'Others',
            ],
            'tab'     => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'       => 'past_illnesses_others',
            'label'      => 'Other(s)',
            'type'       => 'text',
            'attributes' => [
                'id'       => 'past_illnesses_others',
                'disabled' => 'disabled',
            ],
            'tab'     => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'       => 'frequent_sickness_others',
            'label'      => 'Other(s)',
            'type'       => 'text',
            'attributes' => [
                'id'       => 'frequent_sickness_others',
                'disabled' => 'disabled',
            ],
            'tab'     => 'Health Information',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // Yes or No
        CRUD::addField([
            'name'    => 'past_accidents',
            'label'   => 'Has child had any various accidents?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'ishospitalized',
            'label'   => 'Does the child have been hospitalized?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'allergy',
            'label'   => 'Is the child allergic?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'asthma',
            'label'   => 'Asthma',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'drugallergy',
            'label'   => 'Drug Allergy',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'visionproblem',
            'label'   => 'Eye or vision problems',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'hearingproblem',
            'label'   => 'Ear or hearing problems',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'hashealthcondition',
            'label'   => 'Any other health condition that the school should be aware of (e.g epilepsy, diabetes, etc.)',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'medication',
            'label'   => 'Is the child on a regular medication?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'schoolhourmedication',
            'label'   => 'Does child need to take any medication(s) during school hours?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes (if yes, a letter from the Medical Doctor must be submitted and be kept on file and medication(s) will also be kept in school, to be dispensed only by teacher or authorized person.)',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'consent_intro',
            'type'    => 'custom_html',
            'value'   => '<strong>The parent gave consent for the child to receive the following:</strong>',
            'tab'     => 'Health Information',
            'wrapper' => ['class' => 'col-12 mb-3'],
        ]);

        CRUD::addField([
            'name'    => 'firstaidd',
            'label'   => '1. Minor first aid',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'emergencycare',
            'label'   => '2. Emergency care',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'hospitalemergencycare',
            'label'   => '3. Emergency care at the nearest hospital',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);

        CRUD::addField([
            'name'    => 'oralmedication',
            'label'   => '4. Oral non-prescription medication',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Health Information'
        ]);
    }

    // Notification Fields
    public function setNotificationFields()
    {

        CRUD::addField([
            'name'    => 'father_email',
            'label'   => 'Father Email',
            'type'    => 'email',
            'tab'     => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'mother_email',
            'label'   => 'Mother Email',
            'type'    => 'email',
            'tab'     => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'legal_guardian_email',
            'label'   => 'Legal Guardian Email',
            'type'    => 'email',
            'tab'     => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'emergency_email',
            'label'   => 'Emergency Email',
            'type'    => 'email',
            'tab'     => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'billing_email',
            'label'   => 'Billing Email',
            'type'    => 'email',
            'tab'     => 'Notifications',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
    }

    public function setScholasticInformationFields()
    {
        CRUD::addField([
            'name'  => 'previousschool',
            'label' => 'Name of the previous School',
            'type'  => 'textarea',
            'tab'   => 'Scholastic Information',
            // 'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'  => 'previousschooladdress',
            'label' => 'Complete address of the above School (including zip code)',
            'type'  => 'textarea',
            'tab'   => 'Scholastic Information',
            // 'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'            => 'schooltable',
            'label'           => 'School Attended (Do Not Abbreviate)',
            'type'            => 'table',
            'entity_singular' => 'school',
            'columns'         => [
                'department'     => 'Department',
                'previousschool' => 'Name of School',
                'levelattended'  => 'Last Level Attended',
                'yearattended'   => 'Year Attended',
                'honorsreceived' => 'Honors/Awards',
            ],
            'min' => 4,
            // 'max' => 10, // optional
            'tab'     => 'Scholastic Information',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        CRUD::addField([
            'name'            => 'organizatons',
            'label'           => 'Organizations / Clubs',
            'type'            => 'table',
            'entity_singular' => 'line',
            'columns'         => [
                'organization' => 'Organization / Club',
                'position'     => 'Position',
                'year'         => 'Year',
            ],
            'min' => 1,
            // 'max' => 10, // optional
            'tab'     => 'Scholastic Information',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        // Special Skills checklist
        CRUD::addField([
            'name'    => 'skills',
            'label'   => 'Special Skills:',
            'type'    => 'checklist_illness', // custom field
            'options' => [
                'Computer'          => 'Computer',
                'Compution Writing' => 'Compution Writing',
                'Dancing'           => 'Dancing',
                'Singing'           => 'Singing',
                'Cooking'           => 'Cooking',
                'Poem Writing'      => 'Poem Writing',
                'Public Speaking'   => 'Public Speaking',
                'Acting'            => 'Acting',
                'Others'            => 'Others:',
            ],
            'tab' => 'Scholastic Information',
        ]);

        CRUD::addField([
            'name'       => 'skills_others',
            'label'      => 'Other(s)',
            'type'       => 'text',
            'attributes' => [
                'id'       => 'skills_others',
                'disabled' => 'disabled', // start disabled
            ],
            'tab'     => 'Scholastic Information',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        // Custom Script to toggle the above input
        CRUD::addField([
            'name'  => 'custom_script_skills',
            'type'  => 'custom_html',
            'value' => '<script>
            function toggleSkillsOthersInput() {
                const checkboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                const othersInput = document.getElementById("skills_others");

                let checkedValues = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const selectedThreeOrMore = checkedValues.length >= 3;
                const selectedOthers = checkedValues.includes("Others");

                if (selectedThreeOrMore || selectedOthers) {
                    othersInput.disabled = false;
                    othersInput.style.cursor = "text";
                } else {
                    othersInput.disabled = true;
                    othersInput.style.cursor = "not-allowed";
                    othersInput.value = "";
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                toggleSkillsOthersInput();
                const checkboxes = document.querySelectorAll(".checklist-options-container input[type=checkbox]");
                checkboxes.forEach(cb => cb.addEventListener("change", toggleSkillsOthersInput));
            });
            </script>',
            'tab' => 'Scholastic Information',
        ]);

        CRUD::addField([
            'name'    => 'reading_writing',
            'label'   => 'Reading & Writing Skills',
            'type'    => 'select_from_array',
            'options' => [
                'Good'    => 'Good',
                'Fair'    => 'Fair',
                'Limited' => 'Limited',
                'None'    => 'None',
            ],
            'allows_null' => false,
            'default'     => 'Good',
            'tab'         => 'Scholastic Information',
            'wrapper'     => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'verbalproficiency',
            'label'   => 'Verbal Proficiency',
            'type'    => 'select_from_array',
            'options' => [
                'Good'    => 'Good',
                'Fair'    => 'Fair',
                'Limited' => 'Limited',
                'None'    => 'None',
            ],
            'allows_null' => false,
            'default'     => 'Good',
            'tab'         => 'Scholastic Information',
            'wrapper'     => ['class' => 'form-group col-md-6'],
        ]);

        // Major Language Select Field
        CRUD::addField([
            'name'    => 'majorlanguages',
            'label'   => 'Major language used at home',
            'type'    => 'select_from_array',
            'options' => [
                'Tagalog/Filipino' => 'Tagalog/Filipino',
                'English'          => 'English',
                'Korean'           => 'Korean',
                'Chinese'          => 'Chinese',
                'Japanese'         => 'Japanese',
                'Arabic'           => 'Arabic',
                'Other'            => 'Other',
            ],
            'allows_null' => false,
            'default'     => 'Tagalog/Filipino',
            'tab'         => 'Scholastic Information',
            'wrapper'     => ['class' => 'form-group col-md-6'],
            'attributes'  => ['id' => 'major-language-select'],
        ]);

        CRUD::addField([
            'name'    => 'other_language_specify',
            'label'   => 'Specify Other Language:',
            'type'    => 'text',
            'tab'     => 'Scholastic Information',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'id'          => 'other-language-input',
                'disabled'    => 'disabled',
                'style'       => 'cursor: not-allowed;',
                'placeholder' => 'Ex. Brtish, French, etc.',
            ],
        ]);

        CRUD::addField([
            'name'  => 'custom_script',
            'type'  => 'custom_html',
            'value' => '<script>
            function toggleOtherLanguageField() {
                const select = document.getElementById("major-language-select");
                const otherInput = document.getElementById("other-language-input");

                if (select && otherInput) {
                    if (select.value === "Other") {
                        otherInput.removeAttribute("disabled");
                        otherInput.style.cursor = "text";
                    } else {
                        otherInput.setAttribute("disabled", "disabled");
                        otherInput.style.cursor = "not-allowed";
                        otherInput.value = "";
                    }
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                toggleOtherLanguageField();
                const select = document.getElementById("major-language-select");
                if (select) {
                    select.addEventListener("change", toggleOtherLanguageField);
                }
            });
            </script>',
            'tab' => 'Scholastic Information',
        ]);

        CRUD::addField([
            'name'    => 'otherlanguages',
            'label'   => 'Other languages/dialects spoken',
            'type'    => 'table',
            'columns' => [
                'otherlanguages' => 'List below',
            ],
            'entity_singular' => 'line',
            'min'             => 1,
            // 'max' => 10, // optional
            'tab'     => 'Scholastic Information',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        CRUD::addField([
            'name'    => 'remedialhelp',
            'label'   => 'List any participation in advanced level classes (i.e., Advanced Math, Gifted or Talented, Gateway, Writing, etc.)',
            'type'    => 'table',
            'columns' => [
                'remedialhelp' => 'List below',
            ],
            'entity_singular' => 'line',
            'min'             => 1,
            // 'max' => 10, // optional
            'tab'     => 'Scholastic Information',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        CRUD::addField([
            'name'  => 'remedialhelpexplanation',
            'label' => 'Please explain and provide latest testing results.',
            'type'  => 'textarea',
            'tab'   => 'Scholastic Information',
            // 'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name'    => 'otherinfo',
            'label'   => 'Are there any other information you think the teacher should know about your child?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Scholastic Information'
        ]);

        CRUD::addField([
            'name'    => 'disciplinaryproblem',
            'label'   => 'Has your child ever been asked to leave school because of any behavioral/disciplinary problems?',
            'type'    => 'radio',
            'options' => [
                1 => 'Yes',
                0 => 'No',
            ],
            'tab' => 'Scholastic Information'
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

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    public function store()
    {
        $this->decodeTableFieldsFromRequest();
        return $this->traitStore();
    }

    public function update($id)
    {
        $this->decodeTableFieldsFromRequest();
        return $this->traitUpdate($id);
    }

    private function decodeTableFieldsFromRequest()
    {
        $request = $this->crud->getRequest();
        $items = $request->get('authorized_person_to_fetch'); // your repeatable field name

        if (is_array($items)) {
            $decoded = array_map(function ($item) {
                // If you had any table fields inside each repeatable row, decode them here
                // e.g., $item['some_table'] = json_decode($item['some_table'] ?? '', true);
                return $item;
            }, $items);

            $request->request->set('authorized_person_to_fetch', $decoded);
            $this->crud->setRequest($request);
        }
    }
}
