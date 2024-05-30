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
                            <h3 class="card-title">{{ __('Liste des solutions envisageables') }}</h3>
                            <div class="card-tools">
                                {{-- <a href="{{ route('questionnaire.create')}}" class="btn btn-outline-success btn-sm"><span class="fa fa-plus"></span> Add</a> --}}
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
                                        <th>{{ __('Titre de la solution') }} </th>
                                        <th>{{ __('Méthode (Quiz lié)') }} </th>
                                        <th>{{ __('Marge') }} </th>
                                        <th>{{ __('Description') }} </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cpt = 1;
                                    @endphp
                                    @forelse ($solutions as $solution)
                                        <tr>
                                            <td>{{ $cpt++ }}</td>
                                            <td>{{ $solution->intitule }} </td>
                                            <td>
                                                @foreach ($solution->category as $category)
                                                   <strong> {{ $category->name }}</strong>
                                                    @foreach ($questionnaires as $item)
                                                        @if ($item->id == $category->questionnaire_id)
                                                            ({{ $item->name }})
                                                        @endif
                                                    @endforeach
                                                     <br>
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach ($solution->category as $category)
                                                    {{ ']' . $category->pivot->marge_inf . ', ' . $category->pivot->marge_sup . ']' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                {!! $solution->description !!}
                                            </td>
                                            <td style="display: flex !important;">

                                                <form method="post"
                                                    action="{{ route('solution.destroy', $solution->id) }}"
                                                    id="form-delete-product{{ $solution->id }}">

                                                    {{-- <a data-url="{{ route('solution.edit', $solution->id) }}" id="edit_{{ $solution->id }}"
                                                        class="fas fa-pen-alt"
                                                        onclick="edit({{ $solution->id }})"
                                                        style="color: #217fff; margin-left: 5px; margin-right: 5px;"></a> --}}

                                                    @csrf
                                                    @method('delete')
                                                    {{-- <span id="btn-delete-product{{ $solution->id }}"
                                                        onclick="deleteProduct({{ $solution->id }})"
                                                        class="fas fa-trash-alt" style="color: rgb(248, 38, 38)"></span> --}}
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" style="text-align: center"> Aucun solution disponible</td>
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
                    <p class="modal-title h4" style="text-align: center">{{ __("Creation d'une solution") }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.solution.modale-create')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h4" style="text-align: center">{{ __("Creation d'une solution") }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body-edit">
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection



@section('content-js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
@section('dashboard-datatable-js')
    <!-- jQuery -->
    
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
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

        function deleteProduct(i) {
            if (confirm('Voulez-vous supprimer cette solution ?')) {
                $('#form-delete-product' + i).submit();
            }
        }

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

        $('#save-solution').click((e) => {
            e.preventDefault();
            let min = $('#marge_inf').val();
            let max = $('#marge_sup').val();
            console.log("CF");
            if (!ControlRequiredFields($('#solution-form .required'))) {
                return 0;
            }
            if (parseFloat(min) > parseFloat(max)) {
                $('#error-marge').removeAttr('hidden');
                return 0;
            } else {
                $('#error-marge').prop('hidden', true);
            }

            $('#solution-form').submit();

        });

        function edit(id) {
            let url = $('#edit_' + id).data('url');
            let data = {j_son: 'true'};
            
            $('#loader').css('display', 'block');
            $('#loader').html('<div class="text-center"><i style="z-index: 5000; color:green;font-size:30px;">Chargement....</i></div>');
            $.ajax({
                url,
                data,
                success: (data) => {
                    console.log(data);
                    // $('#edit_method').css('display', 'blog');
                    $('#body-edit').html(data.view);
                    $('.summernote').summernote();
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
