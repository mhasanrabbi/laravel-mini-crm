<select class="form-control" name="user_id" id="name">
    @foreach($assigned_users as $assign_user)
    {{-- {{dd($assign_user)}} --}}
    <option value="{{ $assign_user->assignUser->id }}">
        {{ $assign_user->assignUser->name }}
    </option>
    @endforeach
</select>
