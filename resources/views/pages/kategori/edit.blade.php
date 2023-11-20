@extends('layouts.main')
@section('konten')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kembali</a>

                    </div>
                    <div class="col text-right">
                        <h4 class="card-title">Edit Kategori</h4>
                        <p class="card-description">
                            Daftar Kategori Resep Makanan
                        </p>
                    </div>
                </div>
                <div class="container">
                    <form action="{{ route('kategori.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Foto</label>
                            <div class="col-10">
                                <input type="file" class="form-control form-control-md" name="image"
                                    placeholder="Inputkan Type" accept="image/png, image/jpeg" />
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-form-label col-2 d-flex align-tems-center">Nama Kategori</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-md" name="kategori"
                                    placeholder="Inputkan Type" value="{{ $data->nama_kategori }}" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
