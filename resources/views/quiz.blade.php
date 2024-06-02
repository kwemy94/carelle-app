@extends('layouts.layout')

@section('front-end-css')
    <style>
        .error{
            border-color: red !important;
        }
    </style>
@endsection

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

            <!-- Stepper Button -->

            <!-- Stepper content -->
            <div class="bs-stepper-content">

                <form method="POST" action="{{ route('quiz.answer') }}" id="form-quiz">
                    @csrf
                    <div id="test-l-1" role="tabpanel" class="">
                        <div class="card mb-4">
                            <input type="text" hidden name="questionnaire_id" value="{{ $questionnaire->id }}">
                            <div class="card-body">
                                <!-- quiz shell header quiz-->
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <!-- quiz img -->
                                        <a href="#"> <img
                                                src="{{ asset('front-end/assets/images/course/quiz.webp') }}" alt="course"
                                                class="rounded img-4by3-lg" style="width: 40px; height:40px"></a>
                                        <!-- quiz content -->
                                        <div class="ms-3">
                                            <h3 class="mb-0">
                                                <a href="#" class="text-inherit">{{ $questionnaire->name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($questionnaire->questions as $quiz)
                                    <div class="mt-5">
                                        <span>Q{{ $i++ }}</span>
                                        <h3 class="mb-3 mt-1">{{ $quiz->intitule }}</h3>

                                        <div class="list-group">
                                            <div class="list-group-item list-group-item-action " aria-current="true">
                                                <!-- form check -->
                                                <div class="form-check">
                                                    <input class="form-check-input yes-radio-input" type="radio"
                                                        name="lines[r_{{ $quiz->id }}]"
                                                        id="flexRadioDefault{{ $quiz->id }}">
                                                    <label class="form-check-label stretched-link"
                                                        for="flexRadioDefault{{ $quiz->id }}">
                                                        OUI/VRAI
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="list-group-item list-group-item-action">
                                                <!-- form check -->
                                                <div class="form-check">
                                                    <input class="form-check-input no-radio-input" type="radio"
                                                        name="lines[r_{{ $quiz->id }}]"
                                                        id="flexRadioDefault2{{ $quiz->id }}">
                                                    <label class="form-check-label stretched-link"
                                                        for="flexRadioDefault2{{ $quiz->id }}">
                                                        NON/FAUX
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="mt-5">
                                        <h5 class="mb-3 mt-1" style="color: red; text-align:center;">Aucune question
                                            disponible</h5>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                        @if (count($questionnaire->questions) != 0)
                            <div class="mb-3">
                                <span class="wpcf7-form-control-wrap" data-name="message">
                                    <textarea cols="10" rows="4"
                                        class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" aria-required="true"
                                        aria-invalid="false" placeholder="Merci de faire vos observations ici" name="observation"></textarea>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">

                                <button type="submit" id="btn-submit" class="btn btn-primary ">
                                    Envoyer
                                </button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('front-js')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $('#btn-submit').click((e) => {
            e.preventDefault();
            let yesRadioInput = $('.yes-radio-input');
            let noRadioInput = $('.no-radio-input');
            console.log(yesRadioInput.length, noRadioInput.length);
            for (let i = 0; i < yesRadioInput.length; i++) {
                if ($(yesRadioInput[i]).is(':checked')) {
                    $(yesRadioInput[i]).val(1);

                }
                if ($(noRadioInput[i]).is(':checked')) {
                    $(noRadioInput[i]).val(0);

                }
            }

            $('#form-quiz').submit();
        });

        function controlRequiredFields(inputs = $('.required')) {
            let success = true;
            console.log('nbre champ requis : ' + inputs.length);
            for (let i = 0; i < inputs.length; i++) {
                // trim permet d'enlever les tabulation inutile sur un champ
                if (!$(inputs[i]).is(':checked') || $(inputs[i]).val().trim() == '') {
                    $(inputs[i]).addClass('error');
                    success = false;
                } else {
                    $(inputs[i]).removeClass('error');
                }
            }

            return success;
        }
    </script>
@endsection
