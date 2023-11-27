@extends('layouts.main')

@section('title', $title = 'Pembayaran Cover')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <div class="card-header py-3">
                {{-- <a href="{{ route('pembayaran_cover_patner.create') }}" class="btn btn-primary">Tambah</a> --}}
            </div>
            <div class="container mb-2">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-nowrap">
                            <th style="width: 20px">#</th>
                            <th>Pengcover</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $key => $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->User->nama }}</td>
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(Auth::user()->hasRole('super-admin'))
                                        <a class="dropdown-item" href="{{ Route('pembayaran_cover_patner.create', Crypt::encryptString($item->User->id)) }}"><i
                                            class="bx bxs-plus-square me-1"></i>Tambah Pembayaran</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ Route('pembayaran_cover_patner.riwayat', Crypt::encryptString($item->User->id)) }}"><i
                                            class='bx bx-history me-1'></i></i>Riwayat</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
