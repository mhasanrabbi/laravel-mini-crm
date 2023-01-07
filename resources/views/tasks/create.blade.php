@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col mb-2">
        <a class="btn btn-primary" href="{{route('tasks.index')}}" role="button">Back</a>
    </div>
</div>
<div class="card">
    <div class="card-header">Create Tasks</div>
    <div class="card-body">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select class="form-control" name="client_id" id="client">
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
                <label for="client_id" class="form-label">Project</label>
                <select class="form-control" name="project_id" id="project">
                    <option value="" selected>---Choose Project---</option>
                    {{-- @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id')==$project->id ? 'selected' : ''}}>
                        {{ $project->title }}
                    </option>
                    @endforeach --}}
                </select>
                @error('client_id')
                <p class="text-danger">{{$message}} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Assign User</label>
                <select class="form-control" name="user_id" id="user_id">

                </select>
                @error('user_id')
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

<script type="text/javascript">
    // $("select#project_id").change(function() {
    //     var project_id = $(this).children("option:selected").val();
    //     loadData(project_id);
    // });

    // function loadData(project_id) {
    //     $.ajax({
    //         url : '/get_assign_user',
    //         type : 'GET',
    //         data : {
    //             'project_id' : project_id
    //         },
    //         dataType:'html',
    //         success : function(response) {
    //             $("#user_id").html(response);
    //             console.log(respone);
    //         },
    //         error : function(request,error)
    //         {
    //             console.log("Error");
    //         }
    //     });
    // }

    $(document).ready(function()
        {

            $('#client').on('change', function () {

var clientId = this.value;

$("#project").html('');

$.ajax({

    url: "/get-project",

    type: "POST",

    data: {

        client_id: clientId,

        _token: '{{csrf_token()}}'

    },

    dataType: 'json',

    success: function (result) {
        console.log(result);
        var options = '';
            $.each(result, function(index, value) {
                options += '<option value="' + value.id + '">' + value.title + '</option>';
            });
            $('#project').html(options);
    }
});

});
        })


</script>

@endsection
