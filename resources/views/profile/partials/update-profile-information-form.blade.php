<form class="form-horizontal" method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail" name="name"
                value="{{ old('name', $user->name) }}" required autocomplete="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="inputName2"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
        </div>
    </div>

    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-sm">Enregister</button>
        </div>
    </div>
</form>
