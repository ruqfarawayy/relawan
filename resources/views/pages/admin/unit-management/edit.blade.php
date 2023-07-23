@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Unit</h1>
    </div>

    @if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form
                action=" {{ route('unit.update', $unit->id) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Unit</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Nama Unit"
                        value="{{$unit->name}}"
                    />
                </div>
                <div class="form-group">
                    <label for="coach">Nama Pembina</label>
                    <input
                        type="text"
                        class="form-control"
                        name="coach"
                        placeholder="Nama Pembina"
                        value="{{$unit->coach}}"
                    />
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea
                        type="text"
                        class="form-control"
                        name="address"
                    >{{$unit->address}}</textarea>
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Dibentuk</label>
                    <input
                        type="date"
                        class="form-control"
                        name="birth_date"
                        placeholder="Masukkan tanggal"
                        value="{{$unit->birth_date}}"
                    />
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Ubah
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
