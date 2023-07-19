@extends('layouts.admin') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Dokumen</h1>
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
                action=" {{ route('file_encryption.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="form-group">
                    <label for="document">Dokumen</label>
                    <input
                        type="file"
                        class="form-control-file"
                        name="document"
                        accept=".pptx, .xlsx, .pdf, .docx, .txt, image/*"
                    />
                    <small class="form-text text-muted"
                        >File yang diizinkan: PPTX, XLSX, PDF, DOCX, TXT,  file image (.jpg, .png, .jpeg)</small
                    >
                </div>
                <div class="form-group">
                    <label for="encryption_key">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control col-md-4"
                            name="encryption_key"
                            placeholder="masukkan password"
                            value="{{ old('encryption_key') }}"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" onclick="togglePasswordVisibility()"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="information">Keterangan</label>
                    <textarea
                        type="text"
                        class="form-control col-md-4"
                        name="information"
                        placeholder="tulis keterangan disini"
                        value="{{ old('information') }}"
                    ></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('addon-script')
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.querySelector('input[name="encryption_key"]');
        var icon = document.querySelector('.fa-eye');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
