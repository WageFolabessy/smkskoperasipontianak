@extends('layouts.app')

@section('title', 'Jadwal Pelajaran')

@push('scripts')
    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus data ini?`,
                    text: "Jadwal akan terhapus secara permanen!",
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Jadwal per Kelas</h4>
                    <a href="{{ route('admin.jadwal.tambah') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;
                        Tambah Jadwal</a>
                </div>
                <div class="card-body">
                    @if ($jadwal_per_kelas->isEmpty())
                        <div class="alert alert-info">
                            Belum ada jadwal pelajaran yang ditambahkan.
                        </div>
                    @else
                        {{-- Navigasi Tab untuk setiap kelas --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($jadwal_per_kelas as $nama_kelas => $jadwal_kelas)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ Str::slug($nama_kelas) }}" data-toggle="tab"
                                        href="#content-{{ Str::slug($nama_kelas) }}" role="tab">{{ $nama_kelas }}</a>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Konten untuk setiap tab --}}
                        <div class="tab-content" id="myTabContent">
                            @foreach ($jadwal_per_kelas as $nama_kelas => $jadwal_kelas)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="content-{{ Str::slug($nama_kelas) }}" role="tabpanel">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Jam</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Guru</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal_kelas->groupBy('hari') as $hari => $jadwal_harian)
                                                    @foreach ($jadwal_harian as $index => $jadwal)
                                                        <tr>
                                                            @if ($index === 0)
                                                                <td rowspan="{{ $jadwal_harian->count() }}"
                                                                    class="align-middle font-weight-bold">
                                                                    {{ $hari }}</td>
                                                            @endif
                                                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                                            </td>
                                                            <td>{{ $jadwal->mataPelajaran->nama_mapel }}</td>
                                                            <td>{{ $jadwal->guru->user->nama }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <a href="{{ route('admin.jadwal.ubah', $jadwal->id) }}"
                                                                        class="btn btn-success btn-sm mr-2"
                                                                        data-toggle="tooltip" title="Ubah"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    <form method="POST"
                                                                        action="{{ route('admin.jadwal.hapus', $jadwal->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm show_confirm"
                                                                            data-toggle="tooltip" title='Hapus'><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
