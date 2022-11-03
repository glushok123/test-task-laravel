<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepartmentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Validator;
use \App\Models\User;
use \App\Models\DepartmentUser;

/**
 * Class DepartmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepartmentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Department::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/department');
        CRUD::setEntityNameStrings('отдел', 'Отделы');

        $this->validRulesForField = [

            'logo' => 'required|file',

        ];
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label' => "Логотип",
            'name' => "logo",
            'type' => 'image',
            'prefix' => 'public/',
            'height' => '100px',
            'width' => '100px',
        ]); 

        CRUD::addColumn(['name' => 'name', 'label' => "Название"]);
        CRUD::addColumn(['name' => 'description', 'label' => "Описание"]);

        CRUD::addColumn([
            'label'     => 'Сотрудники', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'user', // the method that defines the relationship in your Model
            'entity'    => 'user', // the method that defines the relationship in your Model
            'attribute' => 'id', // foreign key attribute that is shown to user
            'model'     => '\App\Models\DepartmentUser', // foreign key model
        ]); 
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::setValidation(DepartmentRequest::class);

        CRUD::addField(['name' => 'name', 'label' => "Название"]);
        CRUD::addField(['name' => 'description', 'label' => "Описание"]);

        CRUD::addField([
            'name' => 'logo',
            'label' => 'Логотип',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'local',
        ], 'both');

    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
