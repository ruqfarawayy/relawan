@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Unit</h1>
    </div>

    @if ($errors->any() || session('error'))
    <div class="alert-danger">
        <ul>
            @if(session('error'))
            <li>{{ session('error') }}</li>
            @endif
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form
                action=" {{ route('unit.store') }}"
                method="post"
            >
                @csrf
                <div class="form-group">
                    <label for="name">Nama Unit</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Nama Unit"
                        value="{{old('name')}}"
                    />
                </div>
                <div class="form-group">
                    <label for="coach">Nama Pembina</label>
                    <input
                        type="text"
                        class="form-control"
                        name="coach"
                        placeholder="Nama Pembina"
                        value="{{old('coach')}}"
                    />
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Dibentuk</label>
                    <input
                        type="date"
                        class="form-control"
                        name="birth_date"
                        placeholder="Masukkan tanggal"
                        value="{{old('birth_date')}}"
                    />
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Masukkan Alamat"
                    >{{old('address')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        placeholder="Email"
                        value="{{old('email')}}"
                    />
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
