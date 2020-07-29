<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
 
        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $project = new Project();
        $project->empid = $request->employeeId;
        $project->prjnm = $request->name;
        $project->prjdesc = $request->description;
        $project->prjddline = $request->deadline;
 
        if ($project->save())
            return response()->json([
                'success' => true,
                'data' => $project->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Project could not be added'
            ], 500);
    }

    public function show($id)
    {
        $project = Project::find($id);
 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $project->toArray()
        ], 400);
    }

    public function update($id, Request $request)
    {
        $project = Project::find($id);
 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project with id ' . $id . ' not found'
            ], 400);
        }
 
        $project->prjnm = $request->name;
        $project->empid = $request->employeeId;
        $project->prjdesc = $request->description;
        $project->prjddline = $request->deadline;
        $updated = $project->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Project could not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $project = Project::find($id);
 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($project->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Project could not be deleted'
            ], 500);
        }
    }

    public function detail($employeeId)
    {
        $project = DB::table('projects')->where('empid', $employeeId)->get();
 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project with employee id ' . $employeeId . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $project->toArray()
        ], 400);
    }
}
