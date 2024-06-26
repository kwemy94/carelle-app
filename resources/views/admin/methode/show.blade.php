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
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Questions lié : ') }}{{ $category->name }}</h3>
                            <div class="card-tools">
                                {{-- <a href="{{ route('use-method.create')}}" class="btn btn-outline-success btn-sm"><span class="fa fa-plus"></span> Add</a> --}}
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" id="edit_{{ $category->id }}"
                                    data-target="#modal-edit" onclick="editer({{ $category->id }})" data-url={{ route('use-method.edit', $category->id) }}><span class="fa fa-pen"></span> Edit</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>{{ __('Nom de la méthode (Quiz lié)') }} </th>
                                        <th colspan="{{ count($category->questions) + 1 }}">{{ __('Questions liées') }} </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cpt = 1;
                                    @endphp
                                    {{-- @dd(count($category->questions) + 1) --}}
                                    <tr>

                                        <td rowspan="{{ count($category->questions) + 2 }}">
                                            {{ $category->name }} ({{ $category->questionnaire->name }})
                                        </td>
                                        <td colspan="{{ count($category->questions) + 1 }}">
                                            <tr>
                                                <th>Intitulé de la question</th>
                                                <th>Cotation</th>
                                                <th>Type</th>
                                                <th>Réponse</th>
                                            </tr>
                                            @foreach ($category->questions as $question)
                                    <tr>
                                        <td>{{ $question->intitule }}</td>
                                        <td>{{ $question->cotation }}</td>
                                        <td>{{ $question->type == 0? "Importance":($question->type == 1?'Perception':"Attente") }}</td>
                                        <td>{{ $question->response == 1? 'Oui/Vrai' :'Non/Faux'}}</td>

                                    </tr>
                                    @endforeach
                                    </td>

                                    <tr>



                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal edit --}}
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title h4" style="text-align: center">{{ __('Modification de la méthode') }}</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body-edit">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@section('dashboard-datatable-js')
    <!-- jQuery -->
    
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
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });

        function deleteProduct(i) {
            if (confirm('Voulez-vous supprimer cette catégorie ?')) {
                $('#form-delete-product' + i).submit();
            }
        }
    </script>
    <script src="{{ asset('js/edit-category.js') }}"></script>
    <script>
        function ControlRequiredFields(inputs = $('.required')) {
            let success = true;
            console.log('nbre champ requis : ' + inputs.length);
            for (let i = 0; i < inputs.length; i++) {
                if ($(inputs[i]).val() == null || $(inputs[i]).val().trim() ==
                    '') { // trim permet d'enlever les tabulation inutile sur un champ
                    $(inputs[i]).addClass('error');
                    success = false;
                } else {
                    $(inputs[i]).removeClass('error');
                }
            }

            return success;
        }


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
