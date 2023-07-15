@extends('layouts.admin')

@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Relawan</h1>
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif

   <div class="card shadow">
    <div class="card-body">
        <form action=" {{route('volunteers.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">NRA</label>
                <input type="text" class="form-control" name="nra" placeholder="NRA" value="{{old('nra')}}  ">
            </div>
            <div class="form-group">
                <label for="location">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}  ">
            </div>
            <div class="form-group">
                <label for="about">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="m" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="f">
                    <label class="form-check-label" for="exampleRadios2">
                      Female
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="about">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}  ">

            </div>
            <div class="form-group">
                <label for="featured_event">No Hp</label>
                <input type="text" class="form-control" name="phone" placeholder="Masukkan No Hp" value="{{old('phone')}}  ">
            </div>
            <div class="form-group">
                <label for="language">Photo</label>
                <input type="text" class="form-control" name="language" placeholder="Language" value="{{old('language')}}">
            </div>
            <div class="form-group">
                <label for="foods">Alamat</label>
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address')}}">
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
                <label for="type">Golongan Darah</label>
                <input type="text" class="form-control" name="type" placeholder="Type" value="{{old('type')}}  ">
            </div>
            <div class="form-group">
                <label for="price">Tanggal Lahir</label>
                <input price="number" class="form-control" name="price" placeholder="Price" value="{{old('price')}}  ">
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
                <select name="volunteer_type_id" required class="form-control">
                    <option value="">Pilih Pekerjaan</option>
                    @foreach ($volunteer_types as $volunteer_type)
                    <option value="{{ $volunteer_type->id }}">
                        {{ $$volunteer_type->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value=1 checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value=0>
                    <label class="form-check-label" for="exampleRadios2">
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
