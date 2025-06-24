<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function index()
    {
        return view('page.admin.akun.index');
    }

    public function dataTable(Request $request)
    {
        $columns_list = [
            0 => 'name',
            1 => 'email',
            2 => 'user_image',
            3 => 'id',
        ];

        $totalDataRecord = User::where('id', '!=', Auth::id())->count();
        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $akun_data = User::where('id', '!=', Auth::id())
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $akun_data = User::where('id', '!=', Auth::id())
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'LIKE', "%{$search_text}%")
                        ->orWhere('name', 'LIKE', "%{$search_text}%")
                        ->orWhere('email', 'LIKE', "%{$search_text}%");
                })
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = User::where('id', '!=', Auth::id())
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'LIKE', "%{$search_text}%")
                        ->orWhere('name', 'LIKE', "%{$search_text}%")
                        ->orWhere('email', 'LIKE', "%{$search_text}%");
                })->count();
        }

        $data_val = [];
        foreach ($akun_data as $akun_val) {
            $url = route('akun.edit', ['id' => $akun_val->id]);
            $urlDetail = route('akun.detail', $akun_val->id); // Tambahkan ini
            $urlHapus = route('akun.delete', $akun_val->id);

            $img = $akun_val->user_image
                ? asset('storage/profile/' . $akun_val->user_image)
                : asset('vendor/adminlte3/img/user2-160x160.jpg');

            $data_val[] = [
                'name' => $akun_val->name,
                'email' => $akun_val->email,
                'user_image' => "<img src='$img' class='img-thumbnail' width='100px'>",
                'options' => "<a href='$urlDetail' title='Lihat Detail'><i class='fas fa-eye fa-lg text-info me-2'></i></a> 
                                <a href='$url' title='Edit'><i class='fas fa-edit fa-lg me-2'></i></a> 
                                <a style='border: none; background-color:transparent;' class='hapusData' data-id='$akun_val->id' data-url='$urlHapus' title='Hapus'>
                                    <i class='fas fa-trash fa-lg text-danger'></i>
                                </a>"
            ];
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalDataRecord,
            "recordsFiltered" => $totalFilteredRecord,
            "data" => $data_val
        ]);
    }

    public function tambahAkun(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:200|min:3',
                'email' => 'required|string|min:3|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'user_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);

            $img = null;
            if ($request->file('user_image')) {
                $nama_gambar = time() . '_' . $request->file('user_image')->getClientOriginalName();
                $request->file('user_image')->storeAs('public/profile', $nama_gambar);
                $img = $nama_gambar; // hanya nama file
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_image' => $img
            ]);

            return redirect()->route('akun.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.akun.addAkun');
    }

    public function ubahAkun($id, Request $request)
    {
        $usr = User::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:200|min:3',
                'email' => 'required|string|min:3|email|unique:users,email,' . $usr->id,
                'password' => 'required|min:8|confirmed',
                'user_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);

            $img = $usr->user_image;

            if ($request->file('user_image')) {
                if ($img && file_exists(public_path($img))) {
                    unlink(public_path($img));
                }

                $nama_gambar = time() . '_' . $request->file('user_image')->getClientOriginalName();
                $upload = $request->file('user_image')->storeAs('public/profile', $nama_gambar);
                $img = Storage::url($upload);
            }

            $usr->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_image' => $img
            ]);

            return redirect()->route('akun.edit', ['id' => $usr->id])->with('status', 'Data telah diperbarui');
        }

        return view('page.admin.akun.ubahAkun', compact('usr'));
    }

    public function hapusAkun($id)
    {
        $usr = User::findOrFail($id);
        if ($usr->user_image && file_exists(public_path($usr->user_image))) {
            unlink(public_path($usr->user_image));
        }
        $usr->delete();
        return response()->json(['msg' => 'Data yang dipilih telah dihapus']);
    }

    public function detailAkun($id)
    {
        $user = User::with('dataPengguna')->findOrFail($id);
        return view('page.admin.akun.detailakun', compact('user'));
    }
}
