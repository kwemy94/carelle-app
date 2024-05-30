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
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">


                    <!-- PIE CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Resultat du Client {{ $answer->id }}. Quiz :
                                {{ $answer->questionnaire->name }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                    </div>


                </div>

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Solution envisagéable</h3>
                        </div>
                        {{-- /.card-header --}}
                        <div class="card-body">
                            <div class="row">
                                @if (count($dataSolutions) != 0)
                                    @php
                                        $existLabels = [];
                                    @endphp

                                    @foreach ($dataSolutions as $key => $solution)
                                        @php
                                            $existLabels = array_merge($existLabels, [$key]);
                                        @endphp
                                        <div class="col-sm-4">
                                            <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon bg-success">
                                                        {{ $key }}
                                                    </div>
                                                </div>
                                                @if (isset($dataSolutions[$key]))
                                                    <small>{{ $dataSolutions[$key] }}</small>
                                                @else
                                                    <small>Faites une analyse selon le diagramme de résultat
                                                        ci-contre.</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($labels as $item)
                                        @if (!in_array($item, $existLabels))
                                            <div class="col-sm-4">
                                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-success">
                                                            {{ $item }}
                                                        </div>
                                                    </div>
                                                    <small>Faites une analyse selon le diagramme de résultat
                                                        ci-contre.</small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <small>Faites une analyse selon le diagramme de résultat ci-contre.</small>
                                @endif

                            </div>
                        </div>
                        {{-- /.card-body --}}
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection




@section('dashboard-datatable-js')
    <!-- jQuery -->
    <script src="{{ asset('dashboard-template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    {{-- cdn du diagramme --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            if (confirm('Voulez-vous supprimer cette réponse ?')) {
                $('#form-delete-product' + i).submit();
            }
        }
    </script>
    <script>
        const ctx = document.getElementById('pieChart');

        let sizeData = @json($bgColor).length;
        const datas = {

            labels: @json($labels),
            datasets: [{
                label: 'Client ' + @json($answer->id),

                data: @json($datas),
                backgroundColor: [
                    'rgb(205, 99, 132)',
                    sizeData >= 2 ? 'rgb(54, 162, 235)' : '',
                    sizeData >= 3 ? 'rgb(255, 205, 86)' : '',
                    sizeData >= 4 ? 'rgb(255, 5, 40)' : '',
                    sizeData >= 5 ? 'rgb(255, 45, 90)' : '',
                ],
                hoverOffset: 4
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: datas
        });
    </script>
@endsection
