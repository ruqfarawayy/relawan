@extends('layouts.admin') @section('content') @include('includes.admin.flasher')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Dokumen</h1>
        @if (Auth::user()->role == 'admin')
        <a
            href="{{ route('file_encryption.create') }}"
            class="btn btn-sm btn-primary shadow-sm"
        >
            <i class="fas fa-plus fa-sm text-white-50"></i> Encrypt Dokumen
        </a>
        @endif
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
                            <th>Tanggal Dibuat</th>
                            <th>Nama File</th>
                            <th>Ukuran File</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($file_encryptions as $file_encryption)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $file_encryption->created_at }}</td>
                            <td>{{ $file_encryption->file_name }}</td>
                            <td>
                                {{ $file_encryption->file_size }}
                                <span class="mx-0">Kb</span>
                            </td>
                            <td>{{ $file_encryption->information }}</td>
                            <td>
                                <!-- Button untuk membuka modal -->
                                <a
                                    class="btn btn-info decrypt-button"
                                    data-toggle="modal"
                                    data-target="#decryptModal-{{ $file_encryption->id }}"
                                    data-file-id="{{ $file_encryption->id }}"
                                >
                                    <i class="fa fa-pencil-alt"></i>
                                    <small>Decrypt File</small>
                                </a>
                                <!-- Modal Decrypt File -->
                                <div
                                    class="modal fade"
                                    id="decryptModal-{{ $file_encryption->id }}"
                                    tabindex="-1"
                                    aria-labelledby="decryptModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="decryptModalLabel"
                                                >
                                                    Decrypt File
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
                                            <form
                                                id="decryptForm"
                                                action="{{
                                                    route(
                                                        'file_encryption.update',
                                                        $file_encryption
                                                    )
                                                }}"
                                                method="post"
                                            >
                                                @csrf @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label
                                                            for="encryption_key"
                                                            >Password</label
                                                        >
                                                        <input
                                                            type="password"
                                                            class="form-control"
                                                            name="encryption_key"
                                                            placeholder="Enter password"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal"
                                                    >
                                                        Close
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary"
                                                    >
                                                        Decrypt
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form
                                    method="post"
                                    class="d-inline"
                                    action="{{ route('file_encryption.destroy', $file_encryption->id) }}"
                                >
                                    @csrf @method('delete')
                                    <!-- Tombol untuk memunculkan modal konfirmasi -->
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#delete{{ $file_encryption->id }}"
                                    >
                                        <i class="fa fa-trash"></i
                                        ><small>Delete Data</small>
                                    </button>

                                    <!-- Modal konfirmasi -->
                                    <div
                                        class="modal fade"
                                        id="delete{{ $file_encryption->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="confirmDeleteModalLabel"
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="modal-dialog"
                                            role="document"
                                        >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5
                                                        class="modal-title"
                                                        id="confirmDeleteModalLabel"
                                                    >
                                                        Konfirmasi Hapus Data
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
                                                    Apakah Anda yakin ingin
                                                    menghapus
                                                    <b>"{{$file_encryption->file_name}}"</b> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal"
                                                    >
                                                        Batal
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger"
                                                    >
                                                        Hapus
                                                    </button>
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
@endsection @push('addons-script')
<script>
    // Ambil semua elemen tombol "Decrypt File"
    var decryptButtons = document.querySelectorAll(".decrypt-button");

    // Tambahkan event listener untuk mendengarkan klik tombol "Decrypt File"
    decryptButtons.forEach(function (decryptButton) {
        decryptButton.addEventListener("click", function () {
            // Ambil ID dari tombol "Decrypt File" yang diklik
            var fileId = this.getAttribute("data-file-id");

            // Ambil elemen formulir berdasarkan ID
            var decryptForm = document.getElementById("decryptForm-" + fileId);

            // Setel nilai action formulir dengan menggunakan ID dari tombol "Decrypt File"
            decryptForm.action = "/file_encryption/" + fileId;
        });
    });
</script>
<script>
    $(document).ready(function () {
        // When the form is submitted
        $("#decryptForm").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            // Perform an AJAX form submission
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function () {
                    // On successful submission, hide the modal
                    $("#exampleModal").modal("hide");
                },
                error: function () {
                    // Handle errors if needed
                    alert("An error occurred during form submission.");
                },
            });
        });
    });
</script>

@endpush
