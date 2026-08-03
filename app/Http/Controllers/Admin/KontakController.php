<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
class KontakController extends Controller
{
    public function index(Request $request)
    {
        $query = Kontak::orderBy('created_at', 'desc');
        if ($request->status === 'baru') {
            $query->where('dibaca', false);
        } elseif ($request->status === 'selesai') {
            $query->where('dibaca', true);
        }
        $kontaks = $query->paginate(20);
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function toggle(Kontak $kontak)
    {
        $kontak->update(['dibaca' => !$kontak->dibaca]);
        return back()->with('success', 'Status pesan diperbarui.');
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
