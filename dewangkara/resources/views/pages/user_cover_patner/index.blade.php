@extends('layouts.main')

@section('title', $title = 'User Cover Partner')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <div class="card-header py-3">
                <a href="{{ route('user_cover_patner.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="container mb-2">
                <table class="table table-bordered" id="dataTable" >
                    <thead>
                        <tr class="text-nowrap">
                            <th style="width: 20px">#</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Nama Channel</th>
                            <th>Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr ondblclick="window.location='{{ route('user_cover_patner.edit', Crypt::encryptString($user->id)) }}';" style="cursor: pointer;">
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nama }}</td>
                            <td> @if (implode(', ', $user->getRoleNames()->toArray()) == 'cover-patner') Cover Partner @endif</td>
                            <td>
                                @if(!$user->Channels()->exists())
                                -
                                @else
                                @forEach($user->Channels as $channel)
                                {{ $channel->nama_channel }}
                                    @break
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($user->email_verified_at == null)
                                <span class="bg-danger p-1 rounded text-white">Belum Terverifikasi</span>
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('user_cover_patner.verifikasi', Crypt::encryptString($user->id)) }}"><i class='bx bxs-check-square me-1'></i>Verifikasi</a>
                                </div>
                                @else
                                <span class="bg-success p-1 rounded text-white">Terverifikasi</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ Route('user_cover_patner.edit', Crypt::encryptString($user->id)) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a id="delete" href="{{ route('user_cover_patner.destroy', $user) }}" class="dropdown-item" onclick="notificationBeforeDelete(event, this)"><i
                                                class="tf-icons bx bx-trash"></i> Hapus</i></a>
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
