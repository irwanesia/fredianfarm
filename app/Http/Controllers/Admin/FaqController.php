<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
class FaqController extends Controller
{
    public function index() { $faqs = Faq::orderBy('urutan')->orderBy('created_at', 'desc')->paginate(15); return view('admin.faq.index', compact('faqs')); }
    public function create() { return view('admin.faq.form'); }
    public function store(StoreFaqRequest $request) { Faq::create($request->validated()); return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.'); }
    public function edit(Faq $faq) { return view('admin.faq.form', compact('faq')); }
    public function update(UpdateFaqRequest $request, Faq $faq) { $faq->update($request->validated()); return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.'); }
    public function destroy(Faq $faq) { $faq->delete(); return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus.'); }
}
