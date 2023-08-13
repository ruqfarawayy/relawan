@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Relawan</h1>
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
            <form action=" {{ route('volunteer.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nra">NRA</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nra"
                        placeholder="NRA"
                        value="{{ old('nra') }}  "
                    />
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Name"
                        value="{{ old('name') }}  "
                    />
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="male"
                            value="m"
                            checked
                        />
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="female"
                            value="f"
                        />
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}  "
                    />
                </div>
                <div class="form-group">
                    <label for="phone">No Hp</label>
                    <input
                        type="text"
                        class="form-control"
                        name="phone"
                        placeholder="Masukkan No Hp"
                        value="{{ old('phone') }}  "
                    />
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input
                        type="file"
                        class="form-control"
                        name="photo"
                        accept="image/*"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Address"
                        value="{{ old('address') }}"
                    />
                </div>
                <div class="form-group">
                    <label for="occupation">Pekerjaan</label>
                    <select name="occupation_id" required class="form-control">
                        <option value="">Pilih Pekerjaan</option>
                        @foreach ($occupations as $occupation)
                        <option value="{{ $occupation->id }}">
                            {{ $occupation->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="education">Pendidikan</label>
                    <select name="education_id" required class="form-control">
                        <option value="">Pilih Pendidikan</option>
                        @foreach ($educations as $education)
                        <option value="{{ $education->id }}">
                            {{ $education->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="blood_type">Golongan Darah</label>
                    <select name="blood_type" required class="form-control">
                        <option value="">Pilih Golongan Darah</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="o">O</option>
                        <option value="AB">AB</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input
                        type="date"
                        class="form-control"
                        name="birth_date"
                        placeholder="Tanggal Lahir"
                        value="{{ old('birth_date') }}  "
                    />
                </div>
                <div class="form-group">
                    <label for="price">Unit</label>
                    <select name="unit_id" required class="form-control">
                        <option value="">Pilih Unit</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">
                            {{ $unit->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Tipe Relawan</label>
                    <select
                        name="volunteer_type_id"
                        required
                        class="form-control"
                    >
                        <option value="">Pilih Tipe Relawan</option>
                        @foreach ($volunteerTypes as $volunteerType)
                        <option value="{{ $volunteerType->id }}">
                            {{ $volunteerType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Status</label>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="status"
                            id="active"
                            value="1"
                            checked
                        />
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="status"
                            id="inactive"
                            value="2"
                        />
                        <label class="form-check-label" for="inactive">
                            Inactive
                        </label>
                    </div>
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
