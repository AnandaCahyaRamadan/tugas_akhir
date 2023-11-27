@extends('layouts.main')
@section( 'title', $title ='Cover')
@section('content')
<!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
            <div class="row">
                <div class="col">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home"
                            aria-controls="navs-pills-justified-home"
                            aria-selected="true"
                            >
                            <i class="tf-icons bx bx-table"></i> Data
                            {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span> --}}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile"
                            aria-controls="navs-pills-justified-profile"
                            aria-selected="false"
                            >
                            <i class="tf-icons bx bx-plus"></i> Tambah
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-messages"
                            aria-controls="navs-pills-justified-messages"
                            aria-selected="false"
                            >
                            <i class="tf-icons bx bx-message-square"></i> Messages
                            </button>
                        </li>
                        </ul>
                        <div class="tab-content">
                        @include('pages.cover.data')
                        @include('pages.cover.create')
                        @include('pages.cover.edit')
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection