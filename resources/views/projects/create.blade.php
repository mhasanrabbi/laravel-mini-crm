@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col mb-2">
        <a class="btn btn-primary" href="{{route('projects.index')}}" role="button">Back</a>
    </div>
</div>
<div class="card">
    <div class="card-header">Create Projects</div>

    <div class="card-body">
        <form action="{{ route('projects.store') }}" method="POST" id="dynamic_form">
            @csrf
            <div class="form-group mb-3">
                <label for="user_id" class="form-label">Assign User</label>
                <select name="user_id[]" class="form-multi-select" multiple data-coreui-search="true" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name}}
                    </option>
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
                    <option value="{{ $client->id }}" {{ old('client_id')==$client->id ? 'selected' : ''}}>
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
                    value="{{old('title')}}">
                @error('title')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="name" aria-describedby="name"
                    placeholder="Write Here...">{{old('description')}}</textarea>
                @error('description')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" id="name" aria-describedby="name"
                    value="{{old('deadline')}}">
                @error('deadline')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" id="name">
                    @foreach(App\Models\Project::STATUS as $status)
                    <option value="{{ $status }}" {{ old('status')==$status ? 'selected' : '' }}>
                        {{ $status}}
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
