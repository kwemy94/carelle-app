@extends('layouts.layout')

@section('front-content')
    <div class="col-lg-9 col-md-8 col-12">
        @if (Session::has('alert-type') && session('alert-type') == 'success')
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div>
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        @if (Session::has('alert-type') && session('alert-type') == 'error')
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        <div id="courseForm" class="bs-stepper">

            <div class="bs-stepper-content">

                <form>
                    <!-- Content one -->
                    <div id="test-l-1" role="tabpanel" class="">
                        <div class="card mb-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="d-flex align-items-center">

                                        <a href="#"> <img
                                                src="{{ asset('front-end/assets/images/course/quiz.webp') }}" alt="course"
                                                class="rounded img-4by3-lg"></a>

                                        <div class="ms-3">
                                            <h3 class="mb-0">
                                                <a href="#" class="text-inherit"> 👈 Choisissez un quiz !</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
