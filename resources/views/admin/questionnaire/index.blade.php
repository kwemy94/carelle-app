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



@section('dashboard-content')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Liste des questionnaires enregistrés') }}</h3>
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
                                        <th>{{ __('Intitulé du questionnaire') }} </th>
                                        <th>{{ __('Description') }} </th>
                                        <th>{{ __('Statut') }} </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cpt = 1;
                                    @endphp
                                    @forelse ($questionnaires as $questionnaire)
                                        <tr>
                                            <td>{{ $cpt++ }}</td>
                                            <td>{{ $questionnaire->name }} </td>

                                            <td>
                                                {!! $questionnaire->description !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('publish.quiz', $questionnaire->id) }}"
                                                    class="{{ $questionnaire->status == 1 ? 'fa fa-eye' : 'fa fa-eye-slash' }}"
                                                    title="Publier/Cacher"></a>
                                            </td>
                                            <td style="display: flex !important;">

                                                <form method="post"
                                                    action="{{ route('questionnaire.destroy', $questionnaire->id) }}"
                                                    id="form-delete-product{{ $questionnaire->id }}">

                                                    <a data-url="{{ route('questionnaire.edit', $questionnaire->id) }}"
                                                        id ="edit_{{ $questionnaire->id }}" class="fas fa-pen-alt"
                                                        style="color: #217fff; margin-left: 5px; margin-right: 5px;"
                                                        onclick="edit({{ $questionnaire->id }})"></a>

                                                    @csrf
                                                    @method('delete')
                                                    {{-- <span id="btn-delete-product{{ $questionnaire->id }}"
                                                        onclick="deleteProduct({{ $questionnaire->id }})"
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

    {{-- Create modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h4" style="text-align: center">{{ __("Creation d'un questionnaire") }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.questionnaire.modale-create')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Create Edit --}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h4" style="text-align: center">{{ __('Editer le questionnaire') }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-edit">

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
            if (confirm('Voulez-vous supprimer ce questionnaire ?')) {
                $('#form-delete-product' + i).submit();
            }
        }


        function edit(id) {
            let url = $('#edit_' + id).data('url');
            let data = {
                j_son: 'true'
            };

            $('#loader').css('display', 'block');
            $('#loader').html(
                '<div class="text-center"><i style="z-index: 5000; color:green;font-size:30px;">Chargement....</i></div>'
                );
            $.ajax({
                url,
                data,
                success: (data) => {
                    console.log(data);
                    // $('#edit_method').css('display', 'blog');
                    $('.modal-body-edit').html(data.view)
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
