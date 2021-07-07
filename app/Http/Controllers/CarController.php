<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CarController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        $car = Car::orderBy('created_at', 'desc')->paginate(10);
            if($car){                
            return response()->json(['car' => $car,]);
         }
        }
        catch(\Exception $e){
        return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function symptoms()
    {
        try{
        $car = Car::select('symptoms')->get();
        return response()->json(['car' => $car,]);
        }
        catch(\Exception $e){
        return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'symptoms' => 'required|string|min:4|unique:cars',
            'causes' => 'required|',
            'solution' => 'required|min:4',
            'carType' => 'required|',
            'yearOfManufacture' => 'required|',
            'type' => 'string|required',
        ]);
         $user = Auth::user()->id;
           try {
            $car = new Car;
            $car->symptoms = $request->input('symptoms');
            $car->causes = $request->input('causes');
            $car->solution = $request->input('solution');
            $car->carType = $request->input('carType');
            $car->yearOfManufacture = $request->input('yearOfManufacture');
            $car->type = $request->input('type');
            $car->user_id = $user;
            $car->save();
            return response()->json(['car' => $car, 'message' => 'created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
        $car = Car::findOrFail($id);
        if($car) return response()->json(['car' => $car, 'status' => false], 404);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong', 'status' => true], 500);  
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id has Bug
     * @return \Illuminate\Http\Response
     */
    public function showSymptoms($search)
    {
     try{
     // $car = Car::where('symptoms', Input::get('symptoms'))->orWhere('causes', 'like', '%' . Input::get('causes') . '%')->get();
        //$car = Car::all();
        return response()->json(['car' => $search,]);
        }
        catch(\Exception $e){
        return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $this->validate($request, [
            'symptoms' => 'required|string|min:4|unique:cars',
            'causes' => 'required|',
            'solution' => 'required|min:4',
            'carType' => 'required|',
            'yearOfManufacture' => 'required|',
            'type' => 'string',
        ]);
         try {
            $car = Car::findOrFail($id);
            $car->symptoms = $request->input('symptoms');
            $car->causes = $request->input('causes');
            $car->solution = $request->input('solution');
            $car->carType = $request->input('carType');
            $car->yearOfManufacture = $request->input('yearOfManufacture');
            $car->type = $request->input('type');
            $car->save();
            return response()->json(['car' => $car, 'message' => 'changed successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'status' => false], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
            $car = Car::findOrFail($id);
            $car->delete();
            if($car){                
                return response()->json(['car' => $car, 'message'=> 'Deleted successfully', 'status' => true], 200);  
            } else {
                 return response()->json(['message'=> 'Not found', 'status' => true], 200);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);

        }
    }
}
