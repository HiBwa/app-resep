@extends('layouts.main')
@section('konten')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">Resep Masakan</h4>
                        <p class="card-description">
                            Daftar Resep Yang Telah Dibuat oleh User
                        </p>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('resep.create') }}" class="btn btn-warning">Tambah Data</a>
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
                                    Foto Masakan
                                </th>
                                <th>
                                    Judul Resep
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Durasi Masak
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @php
                                    $image = App\Models\FotoResep::where('id_resep', $item->id)->first();
                                    $kategori = App\Models\Kategori::where('id', $item->id_kategori)->first();
                                @endphp
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <img src="{{ Storage::url('resep/' . $image->foto) }}" class="responsive-img"
                                            alt="Responsive Image"
                                            style="    width: 132px;
                                            height: 111px;">
                                    <td>
                                        {{ Str::substr($item->judul, 0, 20) }}...
                                    </td>
                                    <td>
                                        {{ $kategori->nama_kategori }}
                                    </td>
                                    <td>
                                        {{ $item->durasi }} Menit
                                    </td>
                                    <td>
                                        <a href="{{ route('resep.edit', $item->id) }}"
                                            class="btn btn-success btn-sm">Show</a>
                                        <a href="{{ route('resep.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('resep.destroy', $item->id) }}" method="POST"
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
