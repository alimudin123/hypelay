@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Akun')

@section('script_head')
<!-- Bootstrap 5 & DataTables Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📋 Data Akun</h2>
        <nav>
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">🏠 Beranda</a></li>
                <li class="breadcrumb-item active">Akun</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="previewAkun" class="table table-striped table-bordered w-100">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_footer')
<!-- jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    const table = $('#previewAkun').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ route('akun.dataTable') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" }
        },
        columns: [
            { data: "name" },
            { data: "email" },
            { data: "options" }
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
            processing: "Memuat data...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            paginate: {
                next: "➡️",
                previous: "⬅️"
            }
        }
    });

    $('#previewAkun').on('click', '.hapusData', function () {
        const id = $(this).data("id");
        const url = $(this).data("url");

        Swal.fire({
            title: 'Hapus akun ini?',
            text: "Tindakan ini tidak bisa dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { id: id, _token: "{{ csrf_token() }}" },
                    success: function (res) {
                        Swal.fire('Terhapus!', res.msg, 'success');
                        table.ajax.reload();
                    }
                });
            }
        });
    });
});
</script>
@endsection
