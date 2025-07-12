@extends('layouts.app')

@section('title', 'Manajemen Admin')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-admin').DataTable();
        });

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus data ini?`,
                    text: "Data admin akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush

@section('content')
    <section class="section">

        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('sukses') }}
                </div>
            </div>
        @elseif (session('gagal'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('gagal') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Admin</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.admin.create') }}" class="btn btn-primary"><i
                                class="fas fa-plus"></i>&nbsp; Tambah Admin</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-admin">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_admin as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->nama }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('admin.admin.edit', $admin->id) }}"
                                                    class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                @if ($admin->id !== Auth::id())
                                                    <form method="POST"
                                                        action="{{ route('admin.admin.destroy', $admin->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm show_confirm"
                                                            data-toggle="tooltip" title='Hapus'><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
