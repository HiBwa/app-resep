<?php

namespace App\Http\Controllers;

use App\Models\FotoResep;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Resep::orderBy('id', 'DESC')->get();
        return view('pages.resep.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.resep.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('bahan', $request->bahan);
        Session::flash('langkah', $request->langkah);
        Session::flash('durasi', $request->durasi);
        $this->validate($request, [
            'image*'     => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'images'     => 'max:6',
            'judul'     => 'required',
            'deskripsi'     => 'required',
            'bahan'     => 'required',
            'langkah'     => 'required',
            'durasi'     => 'required',
        ]);

        //upload image
        $data = [
            'id_user'     => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'bahan'     => $request->bahan,
            'langkah'     => $request->langkah,
            'durasi'     => $request->durasi,
        ];

        $resep = Resep::create($data);
        // menimpan foto  atau gambar ke dalam tabel resep
        $image = $request->file('image');
        foreach ($image as $images) {
            $images->storeAs('public/resep/', $images->hashName());
            FotoResep::create([
                'id_resep' => $resep->id,
                'foto' => $images->hashName(),
            ]);
        }


        return redirect()->route('resep.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Resep::find($id);
        return view('pages.resep.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Session::flash('durasi', $request->durasi);
        $this->validate($request, [
            'image*'     => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'images'     => 'max:6',
            'judul'     => 'required',
            'deskripsi'     => 'required',
            'bahan'     => 'required',
            'langkah'     => 'required',
            'durasi'     => 'required',
        ]);
        //upload image
        $data = [
            'id_user'     => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'bahan'     => $request->bahan,
            'langkah'     => $request->langkah,
            'durasi'     => $request->durasi,
        ];

        Resep::find($id)->update($data);
        // menimpan foto  atau gambar ke dalam tabel resep
        $image = $request->file('image');
        if ($image) {
            // hapus foto lama
            $oldResep = FotoResep::where('id_resep', $id)->get();
            foreach ($oldResep as $old) {
                Storage::delete('public/resep/' . $old->foto);
                $old->delete();
            }
            // hapus simpan foto baru
            foreach ($image as $images) {
                $images->storeAs('public/resep/', $images->hashName());
                FotoResep::create([
                    'id_resep' => $id,
                    'foto' => $images->hashName(),
                ]);
            }
        }
        return redirect()->route('resep.index')->with('Data berhasil diperbaharui!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldResep = FotoResep::where('id_resep', $id)->get();
        foreach ($oldResep as $old) {
            Storage::delete('public/resep/' . $old->foto);
            $old->delete();
        }
        Resep::find($id)->delete();
        return redirect()->route('resep.index')->with('Data berhasil dihapus!!');
    }
}
