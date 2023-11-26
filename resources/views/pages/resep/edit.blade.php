@extends('layouts.main')
@section('konten')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('resep.index') }}" class="btn btn-primary">Kembali</a>

                    </div>
                    <div class="col text-right">
                        <h4 class="card-title">Edit Resep</h4>
                        <p class="card-description">
                            Daftar Kategori Resep Makanan
                        </p>
                    </div>
                </div>
                <div class="container">
                    <form action="{{ route('resep.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Foto Masakan</label>
                            <div class="col-10">
                                <input type="file" class="form-control form-control-md" name="image[]"
                                    placeholder="Inputkan Type" accept="image/png, image/jpeg" multiple />
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Judul Masakan</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-md" name="judul"
                                    placeholder="Masak Apa Hari ini ?" value="{{ $data->judul }}" required />
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Cerita Masakan Ini</label>
                            <div class="col-10">
                                <textarea name="deskripsi" class="form-control" placeholder="Cerita Dibalik Masakan ini" class="form-control-md"
                                    cols="30" rows="10">{{ $data->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Bahan Bahan</label>
                            <div class="col-10">
                                <textarea name="bahan" class="form-control" placeholder="Kamu Pakai Bahan Apa Saja ?" class="form-control-md"
                                    cols="30" rows="10">{{ $data->bahan }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Langkah Langkah</label>
                            <div class="col-10">
                                <textarea name="langkah" class="form-control" placeholder="Apa saja langkah langkah nya si?" class="form-control-md"
                                    cols="30" rows="10">{{ $data->langkah }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Durasi
                                <small>*Menit</small></label>
                            <div class="col-10">
                                <input type="number" class="form-control" name="durasi"
                                    placeholder="Kamu masak ini dalam waktu berapa Lama si ?" value="{{ $data->durasi }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
