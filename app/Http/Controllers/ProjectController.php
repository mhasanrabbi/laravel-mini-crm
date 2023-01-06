<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with(['user', 'client'])->latest()->filter(request(['search']))->paginate(10);
        // dd($projects);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::select('id', 'name')->role('user')->orderBy('name', 'asc')->get();
        $data['clients'] = Client::select('id', 'company_name')->orderBy('company_name', 'asc')->get();

        return view('projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());


        $formRequest = $request->validate(
            [
                'title' => ['required'],
                'description' => ['required'],
                'deadline' => ['required', 'date'],
                'user_id.*' => ['required', 'exists:users,id'],
                'client_id' => ['required', 'exists:clients,id'],
                'status' => ['required'],
            ]
        );

        // dd($formRequest['user_id']);

        // $project = Project::create($formRequest);

        // dd($formRequest);

        unset($formRequest['user_id']);

        $project = new Project();

        $project->fill($formRequest);

        $project->save();


        // $project = $request->validated();
        // $project->save();
        // $project = Project::save()->$request->validated();

        $project->user()->attach($request->user_id);


        // $user = User::find(1);


        // $project->user()->attach($request->id);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $users = User::select('id', 'name')->role('user')->orderBy('name', 'asc')->get();
        $clients = Client::select('id', 'company_name')->orderBy('company_name', 'asc')->get();


        return view('projects.edit', compact('users', 'clients', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        // dd($request);
        $formRequest = $request->validate(
            [
                'title' => ['required'],
                'description' => ['required'],
                'deadline' => ['required', 'date'],
                'user_id' => ['array'],
                'client_id' => ['required', 'exists:clients,id'],
                'status' => ['required'],
            ]
        );

        // $project->fill($formRequest);
        $project->save();
        // unset($formRequest['user_id']);

        $project->user()->sync($formRequest['user_id']);
        // $project->update($formRequest);

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
