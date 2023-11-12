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
                            <th>Harga</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Varian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->produk_nama }}</td>
                                <td>Rp. {{ number_format($produk->produk_harga, 0, ',', '.') }}</td>
                                <td>{{ $data[$loop->iteration - 1]['tanggal'] }}</td>
                                <td>{{ $produk->kategori->kategori_nama }}</td>
                                <td>{{ $produk->produk_status }}</td>
                                <td>
                                    {{ count($produk->varian) }}

                                    <a title="Detail varian" href="{{ route('varian.show', ['varian' => $produk->id]) }}"
                                        class="btn btn-outline-primary btn-rounded"><i class="fas fa-eye"></i></a>

                                </td>
                                <td>
                                    <button title="Ubah produk" class="btn btn-outline-info btn-rounded" id="edit_btn"
                                        data-bs-toggle="modal" data-bs-target="#edit" data-id_ubah="{{ $produk->id }}"
                                        data-produk_nama_ubah="{{ $produk->produk_nama }}"
                                        data-kategori="{{ $produk->kategori_id }}"
                                        data-produk_harga="{{ $produk->produk_harga }}"
                                        data-produk_keterangan="{{ $produk->produk_keterangan }}"
                                        data-status="{{ $produk->produk_status }}"><i class="fas fa-pen"></i></button>

                                    <button title="Hapus produk" class="btn btn-outline-danger btn-rounded" id="delete_btn"
                                        data-bs-toggle="modal" data-bs-target="#delete" data-id="{{ $produk->id }}"
                                        data-produk_nama="{{ $produk->produk_nama }}"><i class="fas fa-trash"></i></button>
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
                            <textarea name="produk_keterangan" class="form-control summernote" required cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tambah Gambar</label>
                            <input type="file" name="gambar[]" multiple class="form-control">
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
                    <h5 class="modal-title">Ubah Produk</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form enctype="multipart/form-data" id="update_produk" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="produk_nama" placeholder="Nama Produk" id="produk_nama_ubah"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Produk</label>
                            <input type="text" name="produk_harga" placeholder="Harga Produk" id="produk_harga"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Produk Kategori</label>
                            <select name="kategori_id" class="form-select">
                                <option value="">Pilih Kategori</option>
                                <span id="kategori">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            class="item-kategori pilih-kategori{{ $loop->iteration }}">
                                            {{ $kategori->kategori_nama }}</option>
                                    @endforeach
                                </span>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-control">Produk Keterangan</label>
                            <textarea name="produk_keterangan" id="produk_keterangan" class="form-control summernote" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div>
                            <label class="form-label">Produk Status</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="aktif" name="produk_status"
                                id="radio1">
                            <label class="form-check-label" for="radio1">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="tidak aktif" type="radio" name="produk_status"
                                id="radio2" checked>
                            <label class="form-check-label" for="radio2">
                                Tidak aktif
                            </label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
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
                        Yakin hapus produk <b><span id="produk_nama" style="color: red"></span></b> ?
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
                let produk_nama = $(this).data('produk_nama');

                let action = "produk/"
                let gabung = action.concat(id)

                document.getElementById("form_delete").action = gabung
                $('#produk_nama').html(produk_nama);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit_btn', function() {
                let id_ubah = $(this).data('id_ubah')
                let produk_nama_ubah = $(this).data('produk_nama_ubah')
                let kategori = $(this).data('kategori')
                let produk_harga = $(this).data('produk_harga')
                let produk_keterangan = $(this).data('produk_keterangan')
                let produk_status = $(this).data('status')

                let item = document.querySelectorAll('.item-kategori')

                for (let index = 1; index <= item.length; index++) {
                    let option = document.querySelectorAll('.pilih-kategori' + index)
                    for (let j = 0; j < option.length; j++) {
                        if (option[j].value == kategori) {
                            option[j].selected = true
                        }
                    }
                }


                let action = "produk/"
                let gabung = action.concat(id_ubah)

                let radio1 = document.getElementById('radio1')
                let radio2 = document.getElementById('radio2')

                if (radio1.value == produk_status) {
                    radio1.checked = true
                } else {
                    radio2.checked = true
                }

                let a = document.getElementById('update_produk').action = gabung
                $('#produk_nama_ubah').val(produk_nama_ubah)
                $('#produk_harga').val(produk_harga)
                $('#produk_keterangan').summernote('pasteHTML', produk_keterangan);
            });
        });

        $(document).ready(function() {
            $(".close-modal").on("click", function() {
                $("#produk_keterangan").summernote('reset');
            });
        });
    </script>
@endsection
