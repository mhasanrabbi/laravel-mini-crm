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
        <a class="btn btn-primary ml-2" href="{{route('clients.create')}}" role="button">Create Client</a>
        @endif
    </div>
    <div class="col-auto mb-2">
        <form action="{{route('clients.index')}}">
            <div class="input-group">
                <input type="search" placeholder="Search clients" class="form-control" name="search" value="{{old('search')}}">
                <button type="submit" class="btn btn-sm btn-info">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        {{ __('Clients') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Company</th>
                    <th scope="col">TIN</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->company_name }}</td>
                    <td>{{ $client->company_tin }}</td>
                    <td>
                        {{ $client->company_address}}
                    </td>
                    <td>
                        <a href="{{ route('clients.edit', $client)}}" class="btn btn-success btn-sm">Edit</a>

                        @can('delete')

                        <form action="{{ route('clients.destroy', ['client' => $client->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure')" type="submit"
                                class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $clients->links() }}
    </div>
</div>
@endsection
