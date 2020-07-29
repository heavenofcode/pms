<?php

namespace App\Http\Controllers;

use App\SubProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubProjectController extends Controller
{
    public function index()
    {
        $subProjects = SubProject::all();
 
        return response()->json([
            'success' => true,
            'data' => $subProjects
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $subProject = new SubProject();
        $subProject->prjid = $request->projectId;
        $subProject->sbprjnm = $request->name;
        $subProject->sbprdesc = $request->description;
        $subProject->sbprddline = $request->deadline;
 
        if ($subProject->save())
            return response()->json([
                'success' => true,
                'data' => $subProject->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sub Project could not be added'
            ], 500);
    }

    public function show($id)
    {
        $subProject = SubProject::find($id);
 
        if (!$subProject) {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $subProject->toArray()
        ], 400);
    }

    public function update($id, Request $request)
    {
        $subProject = SubProject::find($id);
 
        if (!$subProject) {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project with id ' . $id . ' not found'
            ], 400);
        }
 
        $subProject->prjid = $request->projectId;
        $subProject->sbprjnm = $request->name;
        $subProject->sbprdesc = $request->description;
        $subProject->sbprddline = $request->deadline;
        $updated = $subProject->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sub Project could not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $subProject = SubProject::find($id);
 
        if (!$subProject) {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($subProject->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project could not be deleted'
            ], 500);
        }
    }

    public function detail($projectId)
    {
        $subProject = DB::table('sub_projects')->where('prjid', $projectId)->get();
 
        if (!$subProject) {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project with project id ' . $projectId . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $subProject->toArray()
        ], 400);
    }

    public function deleteByProject($projectId)
    {
        $subProject = DB::table('sub_projects')->where('prjid', $projectId)->get();
 
        if (!$subProject) {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project with project id ' . $id . ' not found'
            ], 400);
        }
 
        if ($subProject->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sub Project could not be deleted'
            ], 500);
        }
    }
}
