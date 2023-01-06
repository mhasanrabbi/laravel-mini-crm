@extends('layouts.app')

@section('content')

@if (session('message'))
<div class="row" id="alert">
    <div class="col">
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col mb-2">
        @if(auth()->user()->can('manage users'))
        <a class="btn btn-primary ml-2" href="{{route('tasks.create')}}" role="button">Create Task</a>
        @endif
    </div>
    <div class="col-auto mb-2">
        <form action="{{route('tasks.index')}}">
            <div class="input-group">
                <input type="search" placeholder="Search projects" class="form-control" name="search" value="{{old('search')}}">
                <button type="submit" class="btn btn-sm btn-info">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        {{ __('Tasks') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Assigned To</th>
                    <th>Client</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th></th>
                    @can('delete')
                    <th></th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->project->title }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->client->company_name }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task)}}" class="btn btn-success btn-sm">Edit</a>
                    </td>
                    @can('delete')
                    <td>
                        <form action="{{ route('tasks.destroy', ['task' => $task->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure')" type="submit"
                                class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
