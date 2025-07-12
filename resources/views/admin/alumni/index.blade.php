@extends('layouts.app')

@section('title', 'Data Alumni')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-alumni').DataTable();
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
                    <h4>Daftar Alumni</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.alumni.tambah') }}" class="btn btn-primary"><i
                                class="fas fa-plus"></i>&nbsp; Tambah Alumni</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-alumni">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_alumni as $alumni)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($alumni->foto)
                                                <img src="{{ Storage::url($alumni->foto) }}" alt="Foto" width="50"
                                                    class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Foto Default"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>{{ $alumni->nama_lengkap }}</td>
                                        <td>{{ $alumni->nis }}</td>
                                        <td>{{ $alumni->jurusan->nama_jurusan }}</td>
                                        <td>{{ $alumni->tahun_lulus }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('admin.alumni.ubah', $alumni->id) }}"
                                                    class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('admin.alumni.hapus', $alumni->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm show_confirm"
                                                        data-toggle="tooltip" title='Hapus'><i
                                                            class="fas fa-trash-alt"></i></button>
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
    </section>
@endsection
