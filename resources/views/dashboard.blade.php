@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<!-- Small boxes (Stat box) -->
    <div class="row">   
        <!-- ./col -->
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$jum_ukm}}</h3>
                    <p>Jumlah UKM</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder"></i>
                </div>
                {{-- <a href="{{ route('article.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a> --}}
                <a href="" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    {{-- <h3>{{ format_uang($jumlahProjekPending) }}</h3> --}}
                    <h3>{{$jum_sektor}}</h3>

                    <p>Sektor Usaha</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder"></i>
                </div>
                {{-- <a href="{{ route('gallery.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a> --}}
                <a href="" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Sektor Usaha Kota Bogor {{ date('Y') }}
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body text-center pb-0">
                    
                </div>
                <div class="card-body pt-0">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->   
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title"><strong>Pembagian Sektor Usaha</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Sektor</th>
                                    <th>Jumlah UKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sektor_ukm as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->sektor_usaha }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Data Tidak tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
            </div>        
        </div>
    </div>
    



<!-- /.row -->

<!-- /.row (main row) -->
@endsection

@push('scripts_vendor')
<script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('scripts')
<script>
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
    var salesChartData = {
        labels: @json($list_sektor),
        datasets: [{
                label: 'Jumlah UKM',
                backgroundColor: 'rgba(10, 123,255, .9)',
                borderColor: 'rgba(10, 123, 255, .8)',
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(10, 123, 255, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(10, 123, 255, 1)',
                data: @json($list_jumlah)
            }
        ]
    }
    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
    })

    
</script>
@endpush