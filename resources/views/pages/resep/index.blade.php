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
                                    Deskripsi
                                </th>
                                <th>
                                    Durasi Masak
                                </th>

                                <th>
                                    Bahan-Bahan
                                </th>
                                <th>
                                    Langkah-Langkah
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
                                        {{ $item->judul }}
                                    </td>
                                    <td>
                                        {{ Str::substr($item->deskripsi, 0, 20) }}...
                                    </td>
                                    <td>
                                        {{ $item->durasi }} Menit
                                    </td>
                                    <td>
                                        {{ Str::substr($item->bahan, 0, 20) }}...
                                    </td>
                                    <td>
                                        {{ Str::substr($item->langkah, 0, 20) }}...
                                    </td>
                                    <td>
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
