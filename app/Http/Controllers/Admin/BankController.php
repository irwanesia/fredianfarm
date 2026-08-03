<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('bank_name')->get();
        return view('admin.bank.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.bank.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:255',
            'icon' => 'nullable|string|max:20',
            'bg_color' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);
        Bank::create($data);
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil ditambahkan');
    }

    public function edit(Bank $bank)
    {
        return view('admin.bank.form', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:255',
            'icon' => 'nullable|string|max:20',
            'bg_color' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);
        $bank->update($data);
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil diperbarui');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil dihapus');
    }
}
