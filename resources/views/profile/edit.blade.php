@extends('layouts.app')

@section('dashboard-content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src='{{ asset("storage/dashboard-template/dist/img/".$user->avatar) }}' alt="User profile">
                            </div>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <form class="form-horizontal" method="POST" action="{{ route('update-avatar') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="exampleInputFile">Photo de profile</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="avatar" id="exampleInputFile" accept="image/*" required>
                                                    <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-sm btn-block"><b>Enregistrer</b></button>
                                    </form>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile
                                        information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Mot de passe</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @include('profile.partials.update-profile-information-form')
                                </div>

                                <div class="tab-pane" id="timeline">
                                    @include('profile.partials.update-password-form')
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
