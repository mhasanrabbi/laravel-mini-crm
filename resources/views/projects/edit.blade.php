@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col mb-2">
        <a class="btn btn-primary" href="{{route('projects.index')}}" role="button">Back</a>
    </div>
</div>
<div class="card">
    <div class="card-header">Edit Project</div>

    <div class="card-body">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id[]" class="form-label">Assign User</label>
                <select class="form-multi-select" name="user_id[]" id="user_id" multiple>
                        @foreach($users as $user)
                        {{-- {{dd(old($user->id))}} --}}
                        <option value="{{ $user->id }}" {{ in_array($user->id, $project->user->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                @error('user_id')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                    <select class="form-control" name="client_id" id="name">
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $project->client_id ? 'selected' : ''}}>
                        {{ $client->company_name }}
                        </option>
                        @endforeach
                    </select>
                @error('client_id')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="name" aria-describedby="name"
                    value="{{$project->title}}">
                @error('title')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea  name="description" class="form-control" id="name" aria-describedby="name" placeholder="Write Here...">{{$project->description}}</textarea>
                @error('description')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" id="name" aria-describedby="name"
                    value="{{$project->deadline}}">
                @error('deadline')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="name">
                        @foreach(App\Models\Project::STATUS  as $status)
                        <option value="{{ $status }}" {{$status == $project->status ? 'selected' : ''}}>
                        {{ $status }}
                        </option>
                        @endforeach
                    </select>
                @error('status')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group my-2">
                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
