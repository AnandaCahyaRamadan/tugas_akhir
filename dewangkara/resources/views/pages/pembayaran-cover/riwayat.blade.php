@extends('layouts.main')

@section('title', $title = 'Riwayat Pembayaran')

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
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Channel</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $key => $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->tanggal_pembayaran }}</td>
                            <td>@currency($item->nominal_pembayaran)</td>
                            {{-- <td><img src="{{ asset('storage/bukti_pembayaran/' . $item->bukti_pembayaran) }}" alt="" width="200px"></td> --}}
                            <td>
                                <ul>
                                    @if (!$item->pivot_channels->isEmpty())
                                        @foreach($item->pivot_channels as $keys => $value)
                                            <li>
                                                {{ $value->nama_channel }} @if (!$loop->last), @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <li>Semua Channel</li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                            @if ($item->status == 'pending')
                                <span class="bg-warning p-2 rounded text-white">Menunggu</span>
                                @endif
                                @if ($item->status == 'success')
                                <span class="bg-success p-2 rounded text-white">Diterima</span>
                                @endif
                            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('cover-patner'))
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ Route('pembayaran_cover_patner.show', Crypt::encryptString($item->id)) }}"><i
                                            class="bx bx-show-alt me-1"></i>Detail</a>
                                        @if(Auth::user()->hasRole('super-admin'))
                                        <a class="dropdown-item" href="{{ Route('pembayaran_cover_patner.edit', Crypt::encryptString($item->id)) }}"><i
                                                class="bx bx-edit-alt me-1"></i>Edit</a>
                                        <a id="delete" href="{{ route('pembayaran_cover_patner.destroy', $item) }}"
                                            class="dropdown-item" onclick="notificationBeforeDelete(event, this)"><i
                                                class=" tf-icons bx bx-trash"></i> Hapus</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
