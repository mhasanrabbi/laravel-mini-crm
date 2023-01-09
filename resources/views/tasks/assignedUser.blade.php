<select class="form-control" name="user_id" id="user_id">
    @foreach($relatedUsers as $relatedUser)
    {{-- {{dd($assign_user)}} --}}
        @foreach ($relatedUser->user as $user)
        {
            <option value="{{ $user->id }}">
                {{ user->name }}
            </option>
        }
        @endforeach
    @endforeach
</select>
