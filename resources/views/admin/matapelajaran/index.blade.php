@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-mapel').DataTable();
        });

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus data ini?`,
                    text: "Data akan terhapus secara permanen!",
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
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('sukses') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mata Pelajaran</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.matapelajaran.tambah') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i>&nbsp; Tambah Mapel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-mapel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mata Pelajaran</th>
                                            <th>Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semua_mapel as $mapel)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mapel->nama_mapel }}</td>
                                                <td>{{ $mapel->jurusan->nama_jurusan }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('admin.matapelajaran.ubah', $mapel->id) }}"
                                                            class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i>
                                                            &nbsp; Ubah</a>
                                                        <form method="POST"
                                                            action="{{ route('admin.matapelajaran.hapus', $mapel->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm show_confirm"
                                                                data-toggle="tooltip" title='Hapus'><i
                                                                    class="fas fa-trash-alt"></i> &nbsp; Hapus</button>
                                                        </form>
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
            </div>
        </div>
    </section>
@endsection
