@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col mb-2">
        <a class="btn btn-primary" href="{{route('users.index')}}" role="button">Back</a>
    </div>
</div>

<div class="card">

    <div class="card-header">Edit user</div>

    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{$user->name}}">
                @error('name')
                    <p class="text-danger">{{ $message}} </p>
                @enderror
              </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="{{$user->email}}">
                @error('email')
                    <p class="text-danger">{{ $message}} </p>
                @enderror
              </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" aria-describedby="address" value="{{$user->address}}">
                @error('address')
                    <p class="text-danger">{{ $message}} </p>
                @enderror
              </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" name="phone" class="form-control" id="phone" aria-describedby="phone" value="{{$user->phone}}">
                @error('phone')
                    <p class="text-danger">{{ $message}} </p>
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
