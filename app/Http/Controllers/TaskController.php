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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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