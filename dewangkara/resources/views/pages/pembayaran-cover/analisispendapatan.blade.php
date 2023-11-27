@extends('layouts.main')

@section('title', $title = 'Analisis Pendapatan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Year Selection -->
    {{-- <div class="mb-3">
        <label for="year" class="form-label">Pilih Tahun:</label>
        <select class="form-select" id="year" name="year">
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <!-- Tambahkan opsi tahun lainnya sesuai kebutuhan -->
        </select>
    </div> --}}
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <div class="card-header py-3"></div>
            <div class="container mb-2">
                {{-- <canvas id="monthlyChart" width="400" height="200"></canvas> --}}
                <div style="width: 100%;">
                    {!! $chart->container() !!}
                </div>

                {!! $chart->script() !!}
            </div>
        </div>
    </div>
</div>
@endsection
