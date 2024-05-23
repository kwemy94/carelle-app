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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('Titre de la solution') }} </th>
                                        <th>{{ __('Méthode') }} </th>
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
                                                    {{ $category->name }} <br>
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach ($solution->category as $category)
                                                    {{ ']' . $category->pivot->marge_inf . ', ' . $category->pivot->marge_sup . ']' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $solution->description }}
                                            </td>
                                            <td style="display: flex !important;">

                                                <form method="post"
                                                    action="{{ route('solution.destroy', $solution->id) }}"
                                                    id="form-delete-product{{ $solution->id }}">

                                                    <a href="{{ route('solution.edit', $solution->id) }}"
                                                        class="fas fa-pen-alt"
                                                        style="color: #217fff; margin-left: 5px; margin-right: 5px;"></a>

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

    @include('admin.solution.modale-create')
@endsection




@section('dashboard-datatable-js')
    <!-- jQuery -->
    <script src="{{ asset('dashboard-template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/custom.js') }}"></script>
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
    </script>
@endsection
