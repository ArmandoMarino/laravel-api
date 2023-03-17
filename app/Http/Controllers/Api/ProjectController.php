<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('is_published', true)->with('type', 'technologies')->orderBy('updated_at', 'DESC')->paginate(5);

        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }

        return response()->json($projects);
        // Se devi mandare più cose
        // return response()->json(compact('projects', 'esempio));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // **********************SHOW PER ID***************************
    // public function show(string $id)
    // {
    //     $project = Project::with('type', 'technologies')->find($id);
    //     if (!$project) return response(null, 404);
    //     return response()->json($project);
    // }

    // **********************SHOW PER SLUG***************************
    public function show(string $slug)
    {
        // Funzione ->first() che prender il primo dalla collection
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if (!$project) return response(null, 404);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function typeProjectsIndex(string $id)
    {
        $type = Type::find($id);
        if (!$type) return response(null, 404);

        // Li prendo così perchè c'è la relzione tra i due
        $projects = Project::with('type', 'technologies')->where('type_id', $id)->orderBy('updated_at', 'DESC')->paginate(5);

        // Giro sui projects per prendere l'immagine
        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }


        return response()->json(compact('projects', 'type'));
    }
}
