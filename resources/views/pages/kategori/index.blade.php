@extends('layouts.main')
@section('konten')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">kategori Resep</h4>
                        <p class="card-description">
                            Daftar Kategori Resep Makanan
                        </p>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('kategori.create') }}" class="btn btn-warning">Tambah Data</a>
                    </div>
                </div>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Foto Kategori
                                </th>
                                <th>
                                    Nama Kategori
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="img-container">
                                        <img src="{{ Storage::url('kategori/' . $item->foto) }}" class="img-fluid"
                                            style="width: 100px; height: 100px;">
                                    </td>
                                    <td>
                                        {{ $item->nama_kategori }}
                                    </td>
                                    <td>
                                        <a href="{{ route('kategori.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                            onclick="return confirm('Yakin Untuk Mengapus Data ?')" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
