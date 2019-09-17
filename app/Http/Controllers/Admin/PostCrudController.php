<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PostRequest as StoreRequest;
use App\Http\Requests\PostRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Auth;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/post');
        $this->crud->setEntityNameStrings('post', 'posts');
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->allowAccess('show');
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row.post');

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        //Columns
        $this->crud->addColumns([
           /*  [
                "name" => "title",
                "label" => "title",
                "type" => "text",
                //"anchor" => [
                //    'href' => function($entry, $column, $crud){
                //        return backpack_url('/post/'.$entry->slug);
                //    },
                //],
            ], */
            'title',
            'slug',
            'content',
            [
                "name" => "thumbnail",
                "label" => "Thumbnail",
                "type" => "image"
            ],
            /* [
                "name" => "tags",
                "label" => "tags",
                'entity'        => 'tag', // the method that defines the relationship in your Model
                'attribute'     => 'name', // foreign key attribute that is shown to user
                'model'         => "App\Models\Tag", // foreign key model
                'allows_null'   => true,
                'pivot'         => true, // on create&update, do you need to add/delete pivot table entries?
            ], */
            'user_id',
            'created_at',
            'updated_at'
        ]);
        if(backpack_user()->hasRole('admin')){
            
             $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
                'label'         => 'Tags',
                'type'          => 'select2_multiple',
                'name'          => 'tag', // the method that defines the relationship in your Model
                'entity'        => 'tag', // the method that defines the relationship in your Model
                'attribute'     => 'name', // foreign key attribute that is shown to user
                'model'         => "App\Models\Tag", // foreign key model
                'allows_null'   => true,
                'pivot'         => true, // on create&update, do you need to add/delete pivot table entries?
                
            ]);
            $this->crud->addField([
                'label' => 'title',
                'name' => 'title',
                'type' => 'text'
            ]);

            $this->crud->addField([
                'label' => 'Thumbnail',
                'name' => 'thumbnail',
                'type' => 'image',
                'upload' => true,
                'aspect_ratio' => 0,
                'crop' => true,
                'filename' => null,
                'src' =>null
            ]);
            $this->crud->addField([
                'label' => 'Content',
                'name' => 'content',
                'type'  => 'wysiwyg'
            ]);
        }
        //Fields
        // add asterisk for fields that are required in PostRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->addCustomCrudFilters();
    }

    public function store(StoreRequest $request)
    {
        //dd(backpack_user()->id);
        //dd($request->thumbnail);
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
    public function addCustomCrudFilters(){

       $this->crud->addFilter([
            'type' => 'date',
            'name' => 'date',
            'label' => 'Created date'
       ],
    false,
    function($value){     
            $this->crud->addClause('where', 'created_at', '>=', $value);
            $this->crud->addClause('where', 'created_at', '<=', $value." 23:59:59");
       });

       $this->crud->addFilter([
        'type' => 'date',
        'name' => 'updatedate',
        'label' => 'Updated date'
        ],
        false,
        function($value){     
        $this->crud->addClause('where', 'updated_at', '>=', $value);
        $this->crud->addClause('where', 'updated_at', '<=', $value." 23:59:59");
   });

    }
       
}
