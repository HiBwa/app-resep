<?php

namespace App\Http\Controllers;

use App\Models\FotoResep;
use App\Models\Kategori;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class MobileApiController extends Controller
{

    public $baseUrl;

    public function __construct()
    {

        $this->baseUrl = config('app.url');
    }

    //api login 
    public function login(Request $request)
    {
        $email = strip_tags($request->input('email'));
        $password = strip_tags($request->input('password'));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'Login gagal, silahkan periksa kembali username dan password anda',
            ]);
        }
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $user = Auth::user();
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Berhasil',
                    'data' => $user,
                ]);
                // return redirect()->intended('/');
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Login Gagal, Silahkan Perikasa kembali username dan password anda',
                ]);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Sepertinya terjadi Kesalahan',
            ]);
        }
    }

    // api registrasi
    public function register(Request $request)
    {
        $name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $password = $request->input('password');

        // $this->validate($request, [
        //     'name' => 'required|min:4',
        //     'email' => 'required|email|unique:users,email',
        //     'username' => 'required|unique:users,username',
        //     'no_hp' => 'required|numeric',
        //     'password' => 'required|min:8',
        // ]);

        $cekEmail = User::where('email', $email)->get();
        if ($cekEmail) {
            return response()->json([
                'status' => 400,
                'message' => 'Email Sudah digunakan'
            ],);
        }
        $userName = User::where('username', $username)->get();
        if ($cekEmail) {
            return response()->json([
                'status' => 400,
                'message' => 'Username Sudah digunakan'
            ],);
        }

        $no_hp = User::where('no_hp', $no_hp)->get();
        if ($cekEmail) {
            return response()->json([
                'status' => 400,
                'message' => 'Nomor Sudah digunakan Sudah digunakan'
            ],);
        }
        $user = User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'no_hp' => $no_hp,
            'password' => Hash::make($password),
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Registrasi Berhasil'
        ],);
    }

    //api registration


    //api check login
    public function cekLogin()
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            return response()->json([
                'status' => 200,
                'message' => 'User Login',
                'data' => Auth::user()
            ],);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }
    }

    // api logout
    public function logout(Request $request)
    {



        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            Auth::logout();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Logout',
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    // api kategori
    public function kategori(Request $request)
    {
        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            $data = Kategori::all();

            foreach ($data as $item) {
                $result[] = [
                    'id' => $item->id,
                    'nama' => $item->nama_kategori,
                    'foto' => $this->baseUrl . '/storage/kategori/' . $item->foto,
                ];
            }

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $result
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    // api menampilkan resep
    public function resep(Request $request)
    {
        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            $data = Resep::all();
            foreach ($data as $item) {
                $user = User::find($item->id_user);
                $katgeori = Kategori::find($item->id_kategori);
                $fotos = FotoResep::where('id_resep', $item->id)->get();
                $result[] = [
                    'id' => $item->id,
                    'id_user' => $item->id_user,
                    'pembuat' => $user->name,
                    'judul' => $item->judul,
                    'id_kategori' => $item->id_kategori,
                    'kategori' => $katgeori->nama_kategori,
                    'deskripsi' => $item->deskripsi,
                    'bahan' => $item->bahan,
                    'langkah' => $item->langkah,
                    'durasi' => $item->durasi,
                    'foto' => array_map(function ($foto) {
                        return [
                            'id' => $foto->id,
                            'image' => $this->baseUrl . '/public/kategori/' . $foto->foto
                        ];
                    }, $fotos->all()),
                ];
            }

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $result
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }
    public function userAktif(Request $request)
    {
        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            $user = User::find(Auth::id());
            $result[] = [
                'id' => $user->id,
                'nama' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'bio' => $user->bio,
                'foto' => $this->baseUrl . '/public/kategori/' . $user->foto,
            ];

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $result
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    // search Global
    public function search(Request $request)
    {
        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        $keyword = $request->input('keyword');
        $result = [];


        if ($headerValue == $token) {
            $data = Resep::where('judul', 'LIKE', '%' . $keyword . '%')->get();
            $usersSearch = User::where('name', 'LIKE', '%' . $keyword . '%')->get();
            foreach ($data as $item) {
                $user = User::find($item->id_user);
                $katgeori = Kategori::find($item->id_kategori);
                $fotos = FotoResep::where('id_resep', $item->id)->get();
                $result[] = [
                    'id' => $item->id,
                    'id_user' => $item->id_user,
                    'pembuat' => $user->name,
                    'judul' => $item->judul,
                    'id_kategori' => $item->id_kategori,
                    'kategori' => $katgeori->nama_kategori,
                    'deskripsi' => $item->deskripsi,
                    'bahan' => $item->bahan,
                    'langkah' => $item->langkah,
                    'durasi' => $item->durasi,
                    'foto' => array_map(function ($foto) {
                        return [
                            'id' => $foto->id,
                            'image' => $this->baseUrl . '/public/kategori/' . $foto->foto
                        ];
                    }, $fotos->all()),
                ];
            }

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $result,
                'user' => $usersSearch,
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    // create resep
    public function createResep(Request $request)
    {
        $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            $data = [
                'id_user'     => Auth::id(),
                'judul'     => $request->judul,
                'id_kategori' => $request->id_kategori,
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


            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Membuat resep',

            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }
}
