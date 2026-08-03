<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = User::orderBy('name')->paginate(20);
        return view('admin.pengguna.index', compact('penggunas'));
    }

    public function create()
    {
        return view('admin.pengguna.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'nullable|in:admin,editor',
        ]);
        $data['role'] = $data['role'] ?? 'editor';
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        return view('admin.pengguna.form', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
    {
        if ($pengguna->id === auth()->id() && $request->input('role', $pengguna->role) !== 'admin') {
            return back()->with('error', 'Tidak dapat mengubah role akun sendiri.');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|min:8',
            'role' => 'nullable|in:admin,editor',
        ]);
        $data['role'] = $data['role'] ?? $pengguna->role;
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $pengguna->update($data);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diubah.');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
        $pengguna->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
