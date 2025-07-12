@extends('layouts.app')

@section('title', 'Manajemen Materi')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-materi').DataTable();
        });

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus materi ini?`,
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
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Materi Anda</h4>
                    <div class="card-header-action">
                        <a href="{{ route('guru.materi.tambah') }}" class="btn btn-primary"><i
                                class="fas fa-plus"></i>&nbsp; Unggah Materi</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-materi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tgl Unggah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_materi as $materi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $materi->judul }}</td>
                                        <td>{{ $materi->kelas->nama_kelas }}</td>
                                        <td>{{ $materi->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ $materi->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ Storage::url($materi->file) }}" target="_blank"
                                                    class="btn btn-info btn-sm mr-2" data-toggle="tooltip" title="Unduh"><i
                                                        class="fas fa-download"></i></a>
                                                <a href="{{ route('guru.materi.ubah', $materi->id) }}"
                                                    class="btn btn-success btn-sm mr-2" data-toggle="tooltip"
                                                    title="Ubah"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('guru.materi.hapus', $materi->id) }}">
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
