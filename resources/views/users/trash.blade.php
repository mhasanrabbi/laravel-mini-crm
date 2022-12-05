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
        <a class="btn btn-primary" href="{{route('users.index')}}" role="button">Back</a>
    </div>
    <div class="col-auto mb-2">
        <form action="{{route('users.trash')}}">
            <div class="input-group">
                <input type="search" placeholder="Search users" class="form-control" name="search">
                <button type="submit" class="btn btn-sm btn-info">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        {{ __('Users') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th>Role</th>
                    <th>Restore</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        {{ $role->name}}
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('users.trash.restore', $user->id)}}" method="POST">
                            @csrf
                            <button onclick="return confirm('Are you sure')" type="submit"
                                class="btn btn-success btn-sm">
                                Restore
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('users.trash.destroy',  $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure')" type="submit"
                                class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>
@endsection
