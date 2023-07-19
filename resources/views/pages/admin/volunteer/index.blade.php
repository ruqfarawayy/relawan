@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between  mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Relawan</h1>
        <a
            href="{{ route('volunteer.create') }}"
            class="btn btn-sm btn-primary shadow-sm"
        >
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Relawan
        </a>
    </div>

    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table table-bordered"
                    width="100%"
                    cellspacing="0"
                >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NRA</th>
                            <th>Unit</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($volunteers as $volunteer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->nra }}</td>
                            <td>{{ $volunteer->unit->name }}</td>
                            <td>{{ $volunteer->gender == 'm' ? 'Laki Laki' : 'Perempuan'}}</td>
                            <td>{{ $volunteer->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#detail{{$volunteer->id}}"
                                >
                                    Detail
                                </button>

                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="detail{{$volunteer->id}}"
                                    tabindex="-1"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                >
                                                    Detail
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span aria-hidden="true"
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label
                                                            for="nra"
                                                            class="col-form-label"
                                                            >NRA</label
                                                        >
                                                        <input
                                                            type="nra"
                                                            class="form-control"
                                                            id="unit`"
                                                            value="{{$volunteer->nra}}"
                                                            disabled
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="recipient-name"
                                                            class="col-form-label"
                                                            >Nama</label
                                                        >
                                                        <input
                                                            type="name"
                                                            class="form-control"
                                                            id="name"
                                                            value="{{$volunteer->name}}"
                                                            disabled
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="unit"
                                                            class="col-form-label"
                                                            >Unit</label
                                                        >
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            id="unit`"
                                                            value="{{$volunteer->unit->name}}"
                                                            disabled
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="volunteer_type_id"
                                                            class="col-form-label"
                                                            >Tipe Relawan</label
                                                        >
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            id="volunteer_type_id"
                                                            value="{{$volunteer->volunteerType->name }}"
                                                            disabled
                                                        />
                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                            for="photo"
                                                            class="col-form-label"
                                                            >Photo</label
                                                        >
                                                        <br>
                                                        <img
                                                            src="{{asset('storage/'.$volunteer->photo)}}"
                                                            class="img-fluid img-thumbnail"
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                                <a
                                                    href="{{route('volunteer.edit', $volunteer->id)}}"
                                                    class="btn btn-info"
                                                >
                                                    <i
                                                        class="fa fa-pencil-alt"
                                                    ></i>
                                                    <span class="text"
                                                        >Edit</span
                                                    >
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('volunteer.destroy', $volunteer->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')

                                    <!-- Tombol untuk memunculkan modal konfirmasi -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Modal konfirmasi -->
                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Kosong</td>
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
