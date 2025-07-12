@extends('layouts.app')

@section('title', 'Manajemen Tugas')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-tugas').DataTable();
        });

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus tugas ini?`,
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
                    <h4>Daftar Tugas Anda</h4>
                    <div class="card-header-action">
                        <a href="{{ route('guru.tugas.tambah') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;
                            Buat Tugas Baru</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-tugas">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Batas Waktu</th>
                                    <th>Jawaban Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_tugas as $tugas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tugas->judul }}</td>
                                        <td>{{ $tugas->kelas->nama_kelas }}</td>
                                        <td>{{ $tugas->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tugas->batas_waktu)->translatedFormat('d F Y, H:i') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $tugas->jawaban_tugas_count }} Siswa</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('guru.tugas.jawaban', $tugas->id) }}"
                                                    class="btn btn-primary btn-sm mr-2" data-toggle="tooltip"
                                                    title="Lihat Jawaban"><i class="fas fa-inbox"></i></a>
                                                <a href="{{ route('guru.tugas.ubah', $tugas->id) }}"
                                                    class="btn btn-success btn-sm mr-2" data-toggle="tooltip"
                                                    title="Ubah"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('guru.tugas.hapus', $tugas->id) }}">
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
