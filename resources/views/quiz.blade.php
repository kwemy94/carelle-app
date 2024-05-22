@extends('layouts.layout')

@section('front-content')
    <div class="col-lg-9 col-md-8 col-12">
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
    </script>
@endsection
