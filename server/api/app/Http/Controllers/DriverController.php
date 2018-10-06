<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Driver;
use Validator;

class DriverController extends Controller
{
    public $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Driver();
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
        $test = $this->model->findOrFail(1);
        
        return response()->json($response, 200);
    }

    public function post(Request $request)
    {
        $driver = $this->createDriver($request->all());
        //validation errors
        if (is_array($driver)) {
            return response()->json($driver, 422);
        }
        //Succesfully created a Route
        return response()->json($driver, 201);
    }

    private function createDriver($data)
    {
        $driver = $this->model;
        //Validate the data 
        $validator = Validator::make($data, [
            'name' => 'required|alpha|min:3',
            'dni' => 'required|alpha_num|min:3|unique:drivers',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $driver->create($data);
        return $driver;
    }

   
}