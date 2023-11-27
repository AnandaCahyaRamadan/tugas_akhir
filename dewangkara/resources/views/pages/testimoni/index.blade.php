@extends('layouts.main')

@section('title', $title = 'Testimoni')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            @if(Auth::user()->hasRole('super-admin'))
            <div class="card-header py-3">
                <a href="{{ route('testimoni.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            @else
            <div class="card-header py-3"></div>
            @endif
            <div class="container mb-2">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-nowrap">
                            <th style="width: 20px">#</th>
                            <th>Testimoni</th>
                            <th>Member</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimoni as $key => $row)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ substr($row->testimoni, 0, 80) }}{{ strlen($row->testimoni) > 80 ? '...' : '' }}</td>
                            <td>{{ $row->User->nama }}</td>
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="{{ Route('testimoni.show', Crypt::encryptString($row->id)) }}"><i
                                                class="bx bx-show-alt me-1"></i> Detail</a> --}}
                                        @if(Auth::user()->hasRole('super-admin'))
                                        <a class="dropdown-item" href="{{ Route('testimoni.edit', Crypt::encryptString($row->id)) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a id="delete" href="{{ route('testimoni.destroy', Crypt::encryptString($row->id)) }}"
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
