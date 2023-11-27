@extends('layouts.main')

@php
    if(Auth::user()->hasRole('publisher')) {
        $title = 'Member Cover Patner';
    } else {
        $title = 'Pengajuan Cover';
    }
@endphp

@section('title', $title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <div class="card-header py-3">
            </div>
            <div class="container mb-2">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-nowrap">
                            <th style="width: 20px">#</th>
                            <th>Judul Lagu</th>
                            <th>Pencipta Lagu</th>
                            <th>Publisher</th>
                            <th>Pengcover</th>
                            <th>Status Cover</th>
                            <th>Status Konten</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $key => $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->katalog->judul }}</td>
                            <td>{{ $item->katalog->pencipta_lagu }}</td>
                            <td>{{ $item->katalog->User->nama }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>
                                @if ($item->status == 'pending')
                                <span class="bg-warning p-1 rounded text-white">Menunggu</span>
                                @endif
                                @if ($item->status == 'accepted')
                                <span class="bg-success p-1 rounded text-white">Diterima</span>
                                @endif
                                @if ($item->status == 'rejected')
                                <span class="bg-danger p-1 rounded text-white">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->is_active == null)
                                <span class="bg-secondary p-1 rounded text-white">Belum Mengajukan</span>
                                @endif
                                @if ($item->is_active == 'pending')
                                <span class="bg-warning p-1 rounded text-white">Menunggu</span>
                                @endif
                                @if ($item->is_active == 'accepted')
                                <span class="bg-success p-1 rounded text-white">Diterima</span>
                                @endif
                                @if ($item->is_active == 'rejected')
                                <span class="bg-danger p-1 rounded text-white">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ Route('pengajuan-cover.show', Crypt::encryptString($item->id)) }}"><i
                                            class="bx bx-show-alt me-1"></i> Detail</a>
                                        @if(Auth::user()->hasRole('super-admin'))
                                        <a id="delete" href="{{ route('pengajuan-cover.destroy', $item) }}"
                                            class="dropdown-item" onclick="notificationBeforeDelete(event, this)"><i
                                                class=" tf-icons bx bx-trash"></i> Hapus</a>
                                        @endif
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
