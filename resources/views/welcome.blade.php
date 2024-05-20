@extends('layouts.layout')

@section('front-content')
    <div class="col-lg-9 col-md-8 col-12">
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
                                                src="{{ asset('front-end/assets/images/course/quiz.webp') }}"
                                                alt="course" class="rounded img-4by3-lg"
                                                ></a>
                                        
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
