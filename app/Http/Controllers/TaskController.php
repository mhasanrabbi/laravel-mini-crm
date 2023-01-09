<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['user', 'client', 'project'])->paginate(20);

        return view('tasks.index', compact('tasks'));
    }

    public function getProject(Request $request)
    {
        $projects = Project::select('title', 'id')->where('client_id', $request->client_id)->get();


        // dd($projects);

        // dd($users->user->get());

        return response()->json($projects);
    }

    public function getUser(Request $request)
    {
        // get users belongs to the project
        // $projectId = request('project_id');

        // dd($request->all());

        $relatedUsers = Project::with('user')->select('title', 'id')->where('client_id', $request->client_id)->get();

        $data = [];

        foreach ($relatedUsers as $relatedUser) {
            $data[] = [
                'users' => $relatedUser->user->pluck('name', 'id')->toArray(),
            ];
        }


        // dd($data);
        // dd($relatedUser->title);
        // foreach ($relatedUser->user as $user)
        // {

        // }



        // dd($relatedUser->user()->get());
        // $users = User::where('project_id', $request->project_id)->get(['name', 'id']);

        // dd($users);
        // $users = User::whereHas('project', function ($query) use ($projectId) {
        //     $query->where('project_id', $projectId);
        // })->get();

        // return response()->json($relatedUsers);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Project::with('user')->get());
        // dd(Project::with('client')->get());

        $data['users'] = User::select('id', 'name')->role('user')->orderBy('name', 'asc')->get();
        $data['clients'] = Client::select('id', 'company_name')->orderBy('company_name', 'asc')->get();
        $data['projects'] = Project::select('id', 'title')->orderBy('title', 'asc')->get();

        return view('tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        // dd($request->all());
        // dd($request->validated());
        if (Task::create($request->validated())) {

            return redirect()->route('tasks.index');
        } else {

            dd('hello');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::select('id', 'name')->role('user')->orderBy('name', 'asc')->get();
        $clients = Client::select('id', 'company_name')->orderBy('company_name', 'asc')->get();
        $projects = Project::select('id', 'title')->orderBy('title', 'asc')->get();

        return view('tasks.edit', compact('users', 'clients', 'projects', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function getAssignUser(Request $request)
    {

        $project_id = $request->project_id;

        $assigned_users = Project::with('assignUser')->where('id', $project_id)->get();

        // foreach ($assigned_users as $users) {
        //     // dd($users);
        //     $data['name'] = $users->assignUser->name;
        //     $data['id'] = $users->assignUser->id;

        //     $datas[] = $data;
        // }

        // return response()->json(['response' => $datas]);
        // return json_encode(['response' => $datas]);

        return view('tasks.assignUserList', compact('assigned_users'));
    }
}