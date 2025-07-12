@extends('layouts.app')

@section('title', 'Data Guru')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-guru').DataTable();
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
                    <h4>Daftar Guru</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.guru.tambah') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;
                            Tambah Guru</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-guru">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_guru as $guru)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($guru->foto)
                                                <img src="{{ Storage::url($guru->foto) }}" alt="Foto" width="50"
                                                    class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Foto Default"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>{{ $guru->user->nama }}</td>
                                        <td>{{ $guru->nip }}</td>
                                        <td>{{ $guru->user->email }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('admin.guru.ubah', $guru->id) }}"
                                                    class="btn btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('admin.guru.hapus', $guru->id) }}">
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
