@extends('layout.admin.main')

@section('content')
    <div class="page-title">
        <div class="row mb-3 mt-4">
            <div class="col-md-6">
                Daftar Produk
            </div>
            <div class="col-md-6">
                <a class="btn btn-sm btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fas fa-plus"></i>
                    Tambah Produk
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
            <div class="card-header">Basic DataTables Table</div>
            <div class="card-body">
                <p class="card-title"></p>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->produk_nama }}</td>
                                <td>
                                    {{-- <button title="Ubah produk" class="btn btn-outline-info btn-rounded" id="edit_btn"
                                        data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $produk->id }}"
                                        data-produk_nama_ubah="{{ $produk->produk_nama }}"
                                        data-produk_gambar="{{ $produk->produk_gambar }}"><i
                                            class="fas fa-pen"></i></button>

                                    <button title="Hapus produk" class="btn btn-outline-danger btn-rounded" id="delete_btn"
                                        data-bs-toggle="modal" data-bs-target="#delete" data-id="{{ $produk->id }}"
                                        data-produk_nama="{{ $produk->produk_nama }}"><i class="fas fa-trash"></i></button>
                                </td> --}}
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
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" action="{{ route('produk.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="produk_nama" autocomplete="off" placeholder="Nama Produk"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Kategori Produk</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Produk Harga</label>
                            <input type="number" name="produk_harga" min="1" required placeholder="Harga Produk"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Produk Keterangan</label>
                            <textarea name="produk_keterangan" id="summernote" class="form-control" required cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" id="update_kategori" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" placeholder="Nama Kategori" id="kategori_nama_ubah"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar saat ini</label>
                            <br>
                            <img width="30%" id="gambar_edit" alt="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Kategori</label>
                            <input type="file" name="gambar_kategori" accept="image/*" placeholder="Foto kategori"
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
                        Yakin hapus kategori <b><span id="kategori_nama" style="color: red"></span></b> ?
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
                let kategori_nama = $(this).data('kategori_nama');

                let action = "kategori/"
                let gabung = action.concat(id)

                document.getElementById("form_delete").action = gabung
                $('#kategori_nama').html(kategori_nama);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit_btn', function() {
                let id_ubah = $(this).data('id')
                let kategori_nama_ubah = $(this).data('kategori_nama_ubah')
                let get_edit_gambar = $(this).data('kategori_gambar')

                let edit_gabung = window.location.origin + "/" + get_edit_gambar

                let url = 'kategori/'
                let url_update = url.concat(id_ubah)
                console.log(url_update);

                document.getElementById('update_kategori').action = url_update
                document.getElementById("gambar_edit").src = edit_gabung
                $('#kategori_nama_ubah').val(kategori_nama_ubah)
            });
        });
    </script>
@endsection
