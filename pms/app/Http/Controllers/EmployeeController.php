<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
 
        return response()->json([
            'success' => true,
            'data' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $employee = new Employee();
        $employee->empnm = $request->name;
        $employee->compid = $request->companyId;
        $employee->usrid = $request->userId;
 
        if ($employee->save())
            return response()->json([
                'success' => true,
                'data' => $employee->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Employee could not be added'
            ], 500);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
 
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $employee->toArray()
        ], 400);
    }
}
