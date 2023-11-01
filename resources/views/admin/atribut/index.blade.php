@extends('layout.admin.main')

@section('content')
    <div class="page-title">
        <div class="row mb-3 mt-4">
            <div class="col-md-6">
                Daftar atribut dari varian <b>{{ $get_varian->varian_nama }}</b>
            </div>
            <div class="col-md-6">
                <a class="btn btn-sm btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fas fa-plus"></i>
                    Tambah Varian
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show elemen-halus" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Atribut dari vatian <b>{{ $get_varian->varian_nama }}</b></div>
            <div class="card-body">
                <p class="card-title"></p>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Atribut</th>
                            <th>Harga Tambahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($atributs as $atribut)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $atribut->atribut_nama }}</td>
                                <td>Rp. {{ number_format($atribut->harga_tambahan, 0, ',', '.') }}</td>
                                <td>
                                    </button>
                                    <button title="Ubah Varian" class="btn btn-outline-info btn-rounded" id="edit_btn"
                                        data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $atribut->id }}"
                                        data-atribut_nama_ubah="{{ $atribut->atribut_nama }}"
                                        data-harga_tambahan="{{ $atribut->harga_tambahan }}"><i
                                            class="fas fa-pen"></i></button>

                                    <button title="Hapus Varian" class="btn btn-outline-danger btn-rounded" id="delete_btn"
                                        data-bs-toggle="modal" data-bs-target="#delete" data-id="{{ $atribut->id }}"
                                        data-atribut_nama="{{ $atribut->atribut_nama }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah atribut baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" action="{{ route('atribut.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Atribut</label>
                            <input type="hidden" name="varian_id" value="{{ $get_varian->id }}">
                            <input type="text" name="atribut_nama" autocomplete="off" placeholder="Nama Atribut"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Tambahan</label>
                            <input type="number" name="harga_tambahan" autocomplete="off" min="1"
                                placeholder="Harga Tambahan" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Varian</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Atribut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" id="update_form" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Atribut</label>
                            <input type="text" name="nama_atribut" placeholder="Nama Atribut" id="atribut_nama_ubah"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Tambahan</label>
                            <input type="number" name="harga_tambahan" placeholder="Harga Tambahan" id="harga_tambahan"
                                class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Atribut</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h3>
                        Yakin hapus atribut <b><span id="atribut_nama" style="color: red"></span></b> ?
                    </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="form_delete" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete_btn', function() {
                let id = $(this).data('id');
                let atribut_nama = $(this).data('atribut_nama');


                document.getElementById("form_delete").action = id
                $('#atribut_nama').html(atribut_nama);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit_btn', function() {
                let id_ubah = $(this).data('id')
                let atribut_nama_ubah = $(this).data('atribut_nama_ubah')
                let harga_tambahan = $(this).data('harga_tambahan')

                document.getElementById('update_form').action = id_ubah
                $('#atribut_nama_ubah').val(atribut_nama_ubah)
                $('#harga_tambahan').val(harga_tambahan)
            });
        });
    </script>
@endsection
