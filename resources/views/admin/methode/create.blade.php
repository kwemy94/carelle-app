@extends('layouts.app')

@section('dashboard-datatable-css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard-template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dashboard-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard-template/dist/css/adminlte.min.css') }}">
@endsection

@section('content-css')
    <style>
        .error {
            border-bottom-color: red !important;
        }
    </style>
@endsection



@section('dashboard-content')
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Creation des composants de la méthode</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('use-method.store') }}" id="form-category">
                            @csrf
                            <div class="card-body" id="ma-modale">
                                <div class="form-group">
                                    <label for="name">{{ __('Nom du composant') }} <em style="color:red">*</em></label>
                                    <input type="text" class="form-control form-control-border border-width-1 required"
                                        name="name" id="name" placeholder="Satisfaction client" required>
                                </div>
                                <div class="form-group">
                                    <label for="questionnaire_id">Questionnaire associé <em
                                            style="color: red">*</em></label>
                                    <select name="questionnaire_id"
                                        class="custom-select form-control-border border-width-1 required"
                                        id="questionnaire_id" required>
                                        <option value="" disabled selected>Choisir</option>
                                        @foreach ($questionnaires as $qestionnaire)
                                            <option value="{{ $qestionnaire->id }}">{{ $qestionnaire->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <h5>Ajouter les questions de la méthode</h5>
                                <div class="form-group">
                                    <label for="name">{{ __('Question 1') }} <em style="color:red">*</em></label>
                                    <input type="text"
                                        class="form-control required-question form-control-border border-width-1 required"
                                        name="lines[question][]" id="q1" placeholder="Satisfaction client" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Cotation') }} <em style="color:red">*</em></label>
                                    <input type="number"
                                        class="form-control required-question cotation form-control-border border-width-1 required"
                                        name="lines[cotation][]" id="q1" min="1" step="0.5"
                                        placeholder="Satisfaction client" required>
                                </div>
                                <div class="form-group">
                                    <label for="response">Réponse 1 <em style="color: red">*</em></label>
                                    <select name="lines[response][]" id="r1"
                                        class="custom-select required-question form-control-border border-width-1 required"
                                        id="response" required>
                                        <option value="" disabled selected>Choisir</option>
                                        <option value="0">Faux / Non</option>
                                        <option value="1">Vrai / Oui</option>

                                    </select>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="form-group error-cotation" hidden>
                                    <label for="" style="color: red">La somme des cotations doit être égale à
                                        100</label>

                                </div>
                            </div>
                            <button type="button" id="new-line" class="btn btn-outline-success btn-sm"
                                title="Autre question"><span class="fa fa-plus"></span> </button>

                            <div class="modal-footer justify-content-between">
                                <button type="submit" id="save-category"
                                    class="btn btn-primary btn-sm">{{ __('Enregistrer') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>

            </div>

        </div>
    </section>
@endsection




@section('dashboard-datatable-js')
    <!-- jQuery -->
    <script src="{{ asset('dashboard-template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->


    <!-- DataTables  & Plugins -->
    <script src="{{ asset('dashboard-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard-template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection

@section('content-js')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $('#new-line').click(() => {
            var a = 2;
            let newQuestion = '<div id="block-question"><div class="form-group">' +
                '<button type="button" id="delete-line" class="btn btn-outline-danger btn-sm" title="Supprimer"><span class="fa fa-trash"></span> </button>' +
                '<label for="name">{{ __('Question') }} <em style="color:red">*</em></label>' +
                '<input type="text" class="form-control required-question form-control-border border-width-1 required"' +
                'name="lines[question][]" id="" placeholder="Satisfaction client" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="name">{{ __('Cotation') }} <em style="color:red">*</em></label>' +
                '<input type="number" class="form-control required-question cotation form-control-border border-width-1 required"' +
                'name="lines[cotation][]" id="q1" min="1" step="0.5" placeholder="Satisfaction client" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="response">Réponse 1 <em style="color: red">*</em></label>' +
                '<select name="lines[response][]" class="custom-select required-question form-control-border border-width-1 required"' +
                'id="response" required>' +
                '<option value="" disabled selected >Choisir</option>' +
                '<option value="0">Faux / Non</option>' +
                '<option value="1">Vrai / Oui</option>' +
                '</select>' +
                '</div></div>';
            if (!ControlRequiredFields($('.required-question'))) {
                alert("Remplir les questions précedente  avant de créer une autre");
                return 0;
            }
            $('#ma-modale').append(newQuestion);

        });

        $("body").on("click", "#delete-line", function() {
            $(this).parents("#block-question").remove();
            console.log(1);
        });

        $('#save-category').click((e) => {
            e.preventDefault();
            let inputs = $('.cotation');
            let sommeCotation = 0;
            if (!ControlRequiredFields($('#form-category .required'))) {
                return 0;
            }
            for (let i = 0; i < inputs.length; i++) {
                sommeCotation += parseFloat($(inputs[i]).val());
            }
            if (sommeCotation != 100) {
                $('.error-cotation').removeAttr('hidden');
                return 0;
            }
            $('#save-category').prop("disabled", true);
            $('#form-category').submit();
        });
    </script>
@endsection
