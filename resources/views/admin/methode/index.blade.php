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
        .error{
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
                            <h3 class="card-title">{{ __('Liste des catégories enregistrés') }}</h3>
                            <div class="card-tools">
                                {{-- <a href="{{ route('use-method.create')}}" class="btn btn-outline-success btn-sm"><span class="fa fa-plus"></span> Add</a> --}}
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                    data-target="#modal-default"><span class="fa fa-plus"></span> Add</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="loader"></div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('Nom de la méthode') }} </th>
                                        <th>{{ __('Questionnaire lié') }} </th>
                                        <th>{{ __('Description') }} </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cpt = 1;
                                    @endphp
                                    @forelse ($methodes as $category)
                                        <tr>
                                            <td>{{ $cpt++ }}</td>
                                            <td><a
                                                    href="{{ route('use-method.show', $category->id) }}">{{ $category->name }}</a>
                                            </td>

                                            <td>
                                                {{ isset( $category->questionnaire->name) ? $category->questionnaire->name : '' }}
                                            </td>
                                            <td>
                                                {{ $category->description }}
                                            </td>
                                            <td style="display: flex !important;">

                                                <form method="post"
                                                    action="{{ route('use-method.destroy', $category->id) }}"
                                                    id="form-delete-product{{ $category->id }}">

                                                    <a data-url="{{ route('use-method.edit', $category->id) }}" onclick="editer({{ $category->id }})"
                                                        class="fas fa-pen-alt"
                                                        id="edit_{{ $category->id }}"
                                                        style="color: #217fff; margin-left: 5px; margin-right: 5px;"></a>

                                                    @csrf
                                                    @method('delete')
                                                    {{-- <span id="btn-delete-product{{ $category->id }}"
                                                        onclick="deleteProduct({{ $category->id }})"
                                                        class="fas fa-trash-alt" style="color: rgb(248, 38, 38)"></span> --}}
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" style="text-align: center"> Aucun questionnaire disponible
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal create --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h4" style="text-align: center">{{ __("Creation des composants de la méthode") }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.methode.modale-create')
                </div>
            </div>
        </div>
    </div>
    {{-- Modal edit --}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h4" style="text-align: center">{{ __("Modification de la méthode") }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body-edit">
                    
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('js/custom.js') }}"></script>


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


        function editer(id){
            let url = $('#edit_'+id).data('url');

            let data = {};
            console.log(url, data);
            $('#loader').css('display', 'block');
            $('#loader').html('<div class="text-center"><i style="z-index: 5000; color:green;font-size:30px;">Chargement....</i></div>');
            $.ajax({
                url,
                data,
                success: (data) => {
                    console.log(data);
                    // $('#edit_method').css('display', 'blog');
                    $('#body-edit').html(data.view)
                    $('#modal-edit').modal('show');
                    $('#loader').css('display', 'none');
                },
                error: (xhr, exception) => {
                    $('#loader').css('display', 'none');
                }
            })
        }
    </script>
@endsection
