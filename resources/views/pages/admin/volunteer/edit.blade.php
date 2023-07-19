@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Relawan</h1>
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
                action=" {{ route('volunteer.update', $volunteers->id) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nra">NRA</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nra"
                        placeholder="NRA"
                        value="{{$volunteers->nra}}"
                    />
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Name"
                        value="{{$volunteers->name}}"
                    />
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                        name="gender" id="male" value="m"
                        {{ $volunteers["gender"] === "m" ? "checked" : "" }}>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                        name="gender" id="female" value="f"
                        {{ $volunteers["gender"] === "f" ? "checked" : "" }}>
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
                        value="{{$volunteers->email}}"
                    />
                </div>
                <div class="form-group">
                    <label for="phone">No Hp</label>
                    <input
                        type="text"
                        class="form-control"
                        name="phone"
                        placeholder="Masukkan No Hp"
                        value="{{$volunteers->phone}}"
                    />
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input
                        type="file"
                        class="form-control"
                        name="photo"
                        accept="image/*"
                        id="photo-input"
                    />
                    @if ($volunteers['photo'])
                    <span id="photo-name">{{ $volunteers["photo"] }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Address"
                        value="{{$volunteers->address}}"
                    />
                </div>
                <div class="form-group">
                    <label for="occupation">Pekerjaan</label>
                    <select name="occupation_id" required class="form-control">
                        <option value="">Pilih Pekerjaan</option>
                        @foreach ($occupations as $occupation)
                            <option value="{{ $occupation->id }}" {{ $volunteers->occupation_id == $occupation->id ? 'selected' : '' }}>
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
                        <option value="{{ $education->id }}" {{ $volunteers->education_id == $education->id ? 'selected' : '' }}>
                            {{ $education->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="blood_type">Golongan Darah</label>
                    <select name="blood_type" required class="form-control">
                        <option value="">Pilih Golongan Darah</option>
                        @foreach (['A', 'B', 'O', 'AB'] as $bloodType)
                            <option value="{{ $bloodType }}" {{ $volunteers->blood_type == $bloodType ? 'selected' : '' }}>{{ $bloodType }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input
                        type="date"
                        class="form-control"
                        name="birth_date"
                        placeholder="Tanggal Lahir"
                        value="{{$volunteers->birth_date}}"
                    />
                </div>
                <div class="form-group">
                    <label for="Unit">Unit</label>
                    <select name="unit_id" required class="form-control">
                            <option value="">Pilih Unit</option>
                            @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ $volunteers->unit_id == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="volunteer_type_id">Tipe Relawan</label>
                    <select
                        name="volunteer_type_id"
                        required
                        class="form-control"
                    >
                    <option value="">Pilih Tipe Relawan</option>
                            @foreach ($volunteerTypes as $volunteerType)
                            <option value="{{ $volunteerType->id }}" {{ $volunteers->volunteer_type_id == $volunteerType->id ? 'selected' : '' }}>
                                {{ $volunteerType->name }}
                            </option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    @foreach (['1' => 'Active', '2' => 'Inactive'] as $value => $label)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="status-{{ $value }}"
                                value="{{ $value }}"
                                {{ $volunteers->status == $value ? 'checked' : '' }}
                            />
                            <label class="form-check-label" for="status-{{ $value }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>


                <button type="submit" class="btn btn-primary btn-block">
                    Ubah
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection @push('addon-script')
<script>
    const photoInput = document.getElementById("photo-input");
    const photoName = document.getElementById("photo-name");

    photoInput.addEventListener("change", () => {
        if (photoInput.files.length > 0) {
            photoName.textContent = photoInput.files[0].name;
        } else {
            photoName.textContent = "";
        }
    });
</script>
@endpush
