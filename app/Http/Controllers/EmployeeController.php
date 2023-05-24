<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Controller dan View
        // $pageTitle = 'Employee List';

        // return view('employee.index', [
        //     'pageTitle' => $pageTitle,
        // ]);

        //Laravel Database
        // $pageTitle = 'Employee List';

        // // RAW SQL QUERY
        // $employees = DB::select('select *, employees.id as employee_id, positions.name as position_name from employees left join positions on employees.position_id = positions.id'
        // );

        // return view('employee.index', [
        // 'pageTitle' => $pageTitle,
        // 'employees' => $employees
        // ]);

        $pageTitle = 'Employee List';

        // ELOQUENT
        $employees = Employee::all();

        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Controller dan View
        // $pageTitle = 'Create Employee';

        // return view('employee.create', compact('pageTitle'));

        // Laravel database
        // $pageTitle = 'Create Employee';
        // // RAW SQL Query
        // $positions = DB::select('select * from positions');
        // $positions = DB::table('positions')
        //             ->select('*')
        //             ->get();
        // return view('employee.create', compact('pageTitle', 'positions'));

        $pageTitle = 'Create Employee';

        // ELOQUENT
        $positions = Position::all();

        return view('employee.create', compact('pageTitle', 'positions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Laravel database
        // $messages = [
        //     'required' => ':Attribute harus diisi.',
        //     'email' => 'Isi :attribute dengan format yang benar',
        //     'numeric' => 'Isi :attribute dengan angka'
        // ];

        // $validator = Validator::make($request->all(), [
        //     'firstName' => 'required',
        //     'lastName' => 'required',
        //     'email' => 'required|email',
        //     'age' => 'required|numeric',
        // ], $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        //  // INSERT QUERY
        // DB::table('employees')->insert([
        // 'firstname' => $request->firstName,
        // 'lastname' => $request->lastName,
        // 'email' => $request->email,
        // 'age' => $request->age,
        // 'position_id' => $request->position,
        // ]);

        // return $request->all();

        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = New Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect()->route('employees.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     Laravel Database
    //     $pageTitle = 'Employee Detail';

    // // RAW SQL QUERY
    // $employees = collect(DB::select(
    //     'select *, employees.id as employee_id, positions.name as position_name
    //     from employees
    //     left join positions on employees.position_id = positions.id where employees.id = ?', [$id]
    // ))->first();
    // $employee = DB::table('employees')
    //             ->select('*', 'employees.id as employee_id', 'positions.name as position_name')
    //             ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
    //             ->where('employees.id', '=', $id)
    //             ->first();

    // return view('employee.show', compact('pageTitle', 'employee'));

        $pageTitle = 'Employee Detail';

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Laravel Database
        // $pagetitle = 'Edit Employee';
        // $positions = DB::table('positions')
        //     ->select('*')
        //     ->get();
        // $employee = DB::table('employees')
        //     ->select('*','employees.id as employee_id','positions.name as positions_name')
        //     ->leftJoin('positions','employees.position_id','positions.id')
        //     ->where('employees.id', $id)
        //     ->first();

        // return view ('employee.edit',compact('pagetitle','positions','employee'));

        $pageTitle = 'Edit Employee';

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        return view('employee.edit', compact('pageTitle', 'positions', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Laravel Database
        // $messages = [
        //     'required' => ':Attribute harus diisi.',
        //     'email' => 'Isi :attribute dengan format yang benar',
        //     'numeric' => 'Isi :attribute dengan angka'
        // ];

        // $validator = Validator::make($request-> all(), [
        //     'firstName' => 'required',
        //     'lastName' => 'required',
        //     'email' => 'required|email',
        //     'age' => 'required|numeric',
        // ], $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()-> withErrors($validator)->withInput();
        // }
        // DB::table('employees')
        // ->where('id', $id)
        // ->update([
        //     'firstname' => $request->input('firstName'),
        //     'lastname' => $request->input('lastName'),
        //     'email' => $request->input('email'),
        //     'age' => $request->input('age'),
        //     'position_id' => $request->input('position')
        // ]);
        // return redirect()->route('employees.index');

        // return view('employees.index', compact('pageTitle','employee'));

        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = Employee::find($id);
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect()->route('employees.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    // Laravel Database
    // // QUERY BUILDER
    // DB::table('employees')
    // ->where('id', $id)
    // ->delete();

    // return redirect()->route('employees.index');

    // ELOQUENT
    Employee::find($id)->delete();

    return redirect()->route('employees.index');

    }
}
