<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Route;
use Validator;

class RouteController extends Controller
{
    public $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Route();
    }

    public function get (Request $request, $id = null) 
    {
        $query = $this->model->newQuery();
        //Apply Filters
        if ($request->has('filters')) {
            $query = SearchController::apply($request, $this->model, $query);  
        }
        //Apply with relations
        if ($request->has('with')) {
            $query = RelationLoaderController::apply($request, $this->model, $query);
        }
        if (is_null($id)) {
            $response = $query->paginate();
        } else {
            $response = $query->where(['id' => $id])->get();
        }
        
        return response()->json($response, 200);
    }

    public function post(Request $request)
    {
        $route = $this->createRoute($request->all());
        //validation errors
        if (is_array($route)) {
            return response()->json($route, 422);
        }
        //Succesfully created a Route
        return response()->json($route, 201);
    }

    public function addDriver(Request $request, $id) {
        $route = $this->model->find($id);
        if (!$route) {
            return response()->json(['details' => 'Route not found'], 404);
        }
        $response = $this->attachDriver($request->all(), $route);
        if (is_array($response)) {
            return response()->json($response, 422);
        }

        return response()->json($response, 201);
    }

    private function createRoute($data)
    {
        $route = $this->model;
        //Validate the data 
        $validator = Validator::make($data, [
            'origin' => 'required|alpha|min:3',
            'destination' => 'required|alpha|min:3',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $route->create($data);
        return $route;
    }

    private function attachDriver($data, $route) {
        $validator = Validator::make($data, [
            'driver_id' => 'required|numeric|min:1|exists:drivers,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $route->drivers()->attach($data['driver_id']);

        return $route;
    }

   
}