@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col mb-2">
        <a class="btn btn-primary" href="{{route('clients.index')}}" role="button">Back</a>
    </div>
</div>
<div class="card">
    <div class="card-header">Create user</div>

    <div class="card-body">
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="name" class="form-label">Contact Person Name</label>
                <input type="text" name="contact_name" class="form-control" id="name" aria-describedby="name"
                    value="{{$client->contact_name}}">
                @error('contact_name')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Contact Person Email</label>
                <input type="email" name="contact_email" class="form-control" id="email" aria-describedby="email"
                    value="{{$client->contact_email}}">
                @error('contact_email')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Contact Person Phone</label>
                <input type="text" name="contact_phone_number" class="form-control" id="phone" aria-describedby="phone"
                    value="{{$client->contact_phone_number}}">
                @error('contact_phone_number')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" id="company_name" aria-describedby="phone"
                    value="{{$client->company_name}}">
                @error('company_name')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_address" class="form-label">Company Address</label>
                <input type="text" name="company_address" class="form-control" id="company_address" aria-describedby="phone"
                    value="{{$client->company_address}}">
                @error('company_address')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_city" class="form-label">Company City</label>
                <input type="text" name="company_city" class="form-control" id="company_city" aria-describedby="phone"
                    value="{{$client->company_city}}">
                @error('company_city')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_zip" class="form-label">Company Adress ZIP</label>
                <input type="text" name="company_zip" class="form-control" id="company_zip" aria-describedby="phone"
                    value="{{$client->company_zip}}">
                @error('company_zip')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_tin" class="form-label">Company TIN</label>
                <input type="text" name="company_tin" class="form-control" id="company_tin" aria-describedby="phone"
                    value="{{$client->company_tin}}">
                @error('company_tin')
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
