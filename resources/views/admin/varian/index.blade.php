@extends('layout.admin.main')

@section('content')
    <div class="page-title">
        <div class="row mb-3 mt-4">
            <div class="col-md-6">
                Daftar Varian dari produk {{ $produk->produk_nama }}
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">Varian dari produk {{ $produk->produk_nama }}</div>
            <div class="card-body">
                <p class="card-title"></p>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Varian</th>
                            <th>Atribut</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($varians as $varian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $varian->varian_nama }}</td>
                                <td>
                                    {{ count($varian->atribut) }}
                                    <a href="" class="btn btn-outline-primary btn-rounded">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    </button>
                                    <button title="Ubah Varian" class="btn btn-outline-info btn-rounded" id="edit_btn"
                                        data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $varian->id }}"
                                        data-varian_nama_ubah="{{ $varian->varian_nama }}"><i
                                            class="fas fa-pen"></i></button>

                                    <button title="Hapus Varian" class="btn btn-outline-danger btn-rounded" id="delete_btn"
                                        data-bs-toggle="modal" data-bs-target="#delete" data-id="{{ $varian->id }}"
                                        data-varian_nama="{{ $varian->varian_nama }}"><i class="fas fa-trash"></i></button>
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
                    <h5 class="modal-title">Tambah Varian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" action="{{ route('varian.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Varian</label>
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="text" name="nama_varian" autocomplete="off" placeholder="Nama Varian"
                                class="form-control" required>
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
                    <h5 class="modal-title">Ubah Varian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" id="update_form" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Varian</label>
                            <input type="text" name="nama_varian" placeholder="Nama Varian" id="varian_nama_ubah"
                                class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Kategori</button>
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
                        Yakin hapus varian <b><span id="varian_nama" style="color: red"></span></b> ?
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
                let varian_nama = $(this).data('varian_nama');


                document.getElementById("form_delete").action = id
                $('#varian_nama').html(varian_nama);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit_btn', function() {
                let id_ubah = $(this).data('id')
                let varian_nama_ubah = $(this).data('varian_nama_ubah')

                document.getElementById('update_form').action = id_ubah
                $('#varian_nama_ubah').val(varian_nama_ubah)
            });
        });
    </script>
@endsection
