<?php
namespace App\Http\Controllers;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request){

        Log::info('Person created using POST method', ['first_name' => $request->first_name,'last_name' => $request->last_name,'age' => $request->age]);

        Person::create([
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'age'=>$request->age,
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    public function destroy($id){
        if(Person::destroy($id)){
          Log::info('Person deleted using DELETE method', ['id' => $id]);
          return response()->json(['status'=>'success']);
        }
          return response()->json(['status'=>'error']);
    }

    public function update(Request $request,$id)
    {
            $person=Person::findOrFail($id);
            Log::info('Person updated using PUT method', ['first_name' => $request->first_name,'last_name' => $request->last_name,'age' => $request->age]);
            $person->update($request->all());

            return response()->json(['status' => 'success','person'=>$person], 200);
    }


    public function read(){
        Log::info('All people were read using GET method');
        return Person::all();
    }

    public function read1($personID){
        $person=Person::findOrFail($personID);
        Log::info('Person read using GET method', ['first_name' => $person->first_name,'last_name' => $person->last_name,'age' => $person->age]);
        return $person;
    }



}
