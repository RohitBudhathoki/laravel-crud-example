<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return view('index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = json_decode(Storage::disk('local')->get('data.json')); 
         return view('welcome')->with('leads',$lead);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request) {
 
        try {
            

            // my data storage location is project_root/storage/app/data.json file.
            $contactInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
        
            $inputData = $request->only(['id','name', 'email', 'phone']);
           
            $inputData['datetime_submitted'] = date('Y-m-d H:i:s');
 
            array_push($contactInfo,$inputData);
    
            Storage::disk('local')->put('data.json', json_encode($contactInfo));
 
            return redirect('/')->with('completed', 'Employee created!');
 
        } catch(Exception $e) {
 
            return ['error' => true, 'message' => $e->getMessage()];
 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = json_decode(Storage::disk('local')->get('data.json'));
        $employee = $employee[$id];
        return view('update')->with('employee',$employee);
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
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
        ]);
        $inputs = $request->all();
        $addr = ($request->name);
        $phone = ($request->phone);
        $email = ($request->email);
        $final_address = array();
        foreach ($addr as $key => $value) {
            $final_address[] = array('address' => $value, 'country'=>$country[$key] );
        }
        $inputs['address'] = json_encode($final_address);        
        $book->update($inputs);
        return redirect('/employees')->with('completed', 'Employee updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employees')->with('completed', 'Employee deleted');
    }   
}
