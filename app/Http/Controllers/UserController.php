<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserAcc;
use Illuminate\Support\Facades\Auth;
use App\Models\TrackingData;

class UserController extends Controller
{

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = UserAcc::where('email', $request->email)
                   ->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);

        // Regenerate session dengan false untuk mencegah invalidasi
         $request->session()->regenerate();


        // Simpan status auth ke session secara eksplisit
        session(['auth' => true]);
        session()->save(); // Paksa session disimpan

        session()->flash('success', 'Login berhasil!');

        $userId = Auth::id(); // Ambil ID pengguna yang login
        $trackingData = TrackingData::where('user_id', $userId)->get();
        // Gunakan redirect dengan intended
        return redirect()->intended(route('tracking'));
    }
    session()->flash('error', 'Email atau password salah!');
    return view('user.login');
}

    public function register(Request $request){
        if (UserAcc::where('username', $request->username)->exists()) {
            session()->flash('error', 'Username ini sudah digunakan, pilih username lain.');
            return view('user.register');
        }

        if (UserAcc::where('email', $request->email)->exists()) {
            session()->flash('error', 'Email ini sudah terdaftar, gunakan email lain.');
            return view('user.register');
        }
        $request->validate([
            'username' => 'required|unique:UserAcc',
            'email' => 'required|email|unique:UserAcc',
            'password' => 'required|confirmed|min:6',
        ]);


        $data = $request->all();
        $data['password'] = bcrypt($data['password']); // Enkripsi password
        UserAcc::create($data);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function editAcc(Request $request, $id)
    {
        $user = UserAcc::find($id);

        // Cek apakah ada field yang diisi
        if (!$request->filled('username') && !$request->filled('email') && !$request->filled('password')) {
            session()->flash('error', 'Minimal isi salah satu field untuk melakukan update.');
            return view('user.edit_acc');
        }

        // Validasi password jika diisi
        if ($request->filled('password')) {
            if (strlen($request->password) < 6) {
                session()->flash('error', 'Password minimal 6 karakter.');
                return view('user.edit_acc');
            }
            if ($request->password !== $request->password_confirmation) {
                session()->flash('error', 'Password dan konfirmasi password tidak cocok.');
                return view('user.edit_acc');
            }
        }

        // Cek username jika diisi
        if ($request->filled('username')) {
            // Cek jika username yang diinput sama dengan username user lain
            $existingUser = UserAcc::where('username', $request->username)->first();

            if ($existingUser && $existingUser->id == $user->id) {
                session()->flash('error', 'Username ini sama dengan sebelumnya atau sudah digunakan oleh user lain.');
                return view('user.edit_acc');
            }

            $user->username = $request->username;
        }

        // Cek email jika diisi
        if ($request->filled('email')) {
            // Cek jika email yang diinput sama dengan email user lain
            $existingUser = UserAcc::where('email', $request->email)->first();

            if ($existingUser && $existingUser->id == $user->id) {
                session()->flash('error', 'Email ini sama dengan sebelumnya atau sudah digunakan oleh user lain.');
                return view('user.edit_acc');
            }

            $user->email = $request->email;
        }

        // Cek password jika diisi
        if ($request->filled('password')) {
            if (Hash::check($request->password, $user->password)) {
                session()->flash('error', 'Password baru tidak boleh sama dengan password sebelumnya.');
                return view('user.edit_acc');
            }
            $user->password = bcrypt($request->password);
        }

        // Cek apakah ada perubahan
        if (!$user->isDirty()) {
            session()->flash('error', 'Tidak ada perubahan data yang dilakukan.');
            return view('user.edit_acc');
        }

        // Simpan perubahan
        $user->save();

        session()->flash('success', 'Akun berhasil diperbarui.');
        return view('user.edit_acc');
    }

    public function logout(Request $request)
    {
        //dd($request->session()->all());
        Auth::logout();
        $request->session()->invalidate(); // Menghapus semua data sesi
        $request->session()->regenerateToken(); // Membuat CSRF token baru
        return redirect('/login'); // Redirect ke halaman login
    }


    public function eraseAcc($id){
        UserAcc::find($id)->delete();
        return redirect()->route('login');
    }

}
