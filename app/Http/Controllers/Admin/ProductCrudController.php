<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');

        $this->crud->setColumns([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description'
            ],
            [
                'name' => 'price',
                'type' => 'number',
                'label' => 'Price',
                'prefix' => '$',
                'decimals' => 2
            ],
            [
                'name' => 'quantity',
                'type' => 'number',
                'label' => 'Quantity'
            ],
            [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Category',
                'entity' => 'category', // the method that defines the relationship in your Model
                'model' => 'App\Models\Category', // foreign key model
                'attribute' => 'name' // foreign key attribute that is shown to user
            ],
        ]);

        // Define the fields
        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description'
            ],
            [
                'name' => 'price',
                'type' => 'number',
                'label' => 'Price',
                'prefix' => '$',
                'decimals' => 2
            ],
            [
                'name' => 'quantity',
                'type' => 'number',
                'label' => 'Quantity'
            ],
            [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Category',
                'entity' => 'category', // the method that defines the relationship in your Model
                'model' => 'App\Models\Category', // foreign key model
                'attribute' => 'name' // foreign key attribute that is shown to user
            ],
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
         // Add custom column for category name
         $this->crud->addColumn([
            'name' => 'category_id', // The db column name
            'type' => 'select',
            'label' => 'Category',
            'entity' => 'category', // the method that defines the relationship in your Model
            'model' => 'App\Models\Category', // foreign key model
            'attribute' => 'name' // foreign key attribute that is shown to user
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
