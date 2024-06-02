<form class="form-horizontal" method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Mot de passe actuel</label>
        <div class="col-sm-10">
            <input type="password" name="current_password" class="form-control" id="inputEmail">
        </div>
        <span class="mt-2" :messages="$errors - > updatePassword - > get('current_password')"></span>
    </div>
    <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">Nouveau mot de passe</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputName2">
        </div>
        <span class="mt-2" :messages="$errors - > updatePassword - > get('password')"></span>
    </div>
    <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password_confirmation" id="inputName">
        </div>
        <span class="mt-2" :messages="$errors - > updatePassword - > get('password_confirmation')"></span>
    </div>


    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
        </div>
    </div>
</form>
