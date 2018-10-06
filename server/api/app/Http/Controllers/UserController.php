<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class UserController extends Controller
{
    public $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new User();
    }

    public function get (Request $request, $id = null) 
    {
        $query = $this->model->newQuery();
        /* //Apply Filters
        if ($request->has('filters')) {
            $query = SearchController::apply($request, $this->model, $query);  
        }
        //Apply with relations
        if ($request->has('with')) {
            $query = RelationLoaderController::apply($request, $this->model, $query);
        } */

        if (is_null($id)) {
            $response = $query->paginate();
        } else {
            $response = $query->where(['id' => $id])->get();
        }

        return response()->json($response, 200);
    }
}