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
        <a class="btn btn-primary ml-2" href="{{route('projects.create')}}" role="button">Create Project</a>
        @endif
    </div>
    <div class="col-auto mb-2">
        <form action="{{route('projects.index')}}">
            <div class="input-group">
                <input type="search" placeholder="Search projects" class="form-control" name="search" value="{{old('search')}}">
                <button type="submit" class="btn btn-sm btn-info">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        {{ __('Projects') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th >Assigned To</th>
                    <th>Client</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    @can('delete')
                    <th>Edit</th>
                    <th>Delete</th>
                    @endcan
                </tr>
            </thead>
            <tbody>

                @foreach($projects as $project)
                {{-- {{dd($project)}} --}}
                <tr>
                    <td>{{ $project->title }}</td>
                    {{-- {{dd($user)}} --}}
                    <td >
                        @foreach($project->user as $user)
                        <ul class="list-group horizontal">
                            <li class="list-group-item">
                                {{ $user->name }}
                            </li>
                        </ul>
                        @endforeach
                    </td>
                    <td>{{ $project->client->company_name }}</td>
                    <td>{{ $project->deadline }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project)}}" class="btn btn-success btn-sm">Edit</a>
                    </td>
                    @can('delete')
                    <td>

                        <form action="{{ route('projects.destroy', ['project' => $project->id])}}" method="POST">
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
        {{ $projects->links() }}
    </div>
</div>
@endsection
