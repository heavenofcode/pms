<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
 
        return response()->json([
            'success' => true,
            'data' => $companies
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $company = new Company();
        $company->compnm = $request->name;
 
        if ($company->save())
            return response()->json([
                'success' => true,
                'data' => $company->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Company could not be added'
            ], 500);
    }
}
