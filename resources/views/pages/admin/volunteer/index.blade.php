@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Relawan</h1>
        <a href="{{ route('volunteer.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Relawan
        </a>
    </div>

    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width='100%' cellspacing="0" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NRA</th>
                            <th>Unit</th>
                            <th>Gender</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($volunteers as $volunteer)
                        <tr>
                            <td> {{ $volunteers->id }} </td>
                            <td> {{ $volunteers->name }} </td>
                            <td> {{ $volunteers->nra }} </td>
                            <td> {{ $volunteers->unit }} </td>
                            <td> {{ $volunteers->gender }} </td>
                            <td> {{ $volunteers->status }} </td>
                            <td>
                                <a href="#" class="btn btn-info">
                                <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form action="#" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </form>
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
