<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Bank;
use App\Models\Produk;
use App\Models\ProdukVariant;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::orderBy('created_at', 'desc');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('source')) {
            $query->where('order_source', $request->source);
        }
        $orders = $query->paginate(20);
        $banks = Bank::where('is_active', true)->get();
        $produks = Produk::with('variants')->where('is_active', true)->orderBy('nama')->get();
        return view('admin.order.index', compact('orders', 'banks', 'produks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_source' => 'required|in:wa,tiktok,shopee,manual',
            'customer_name' => 'required|string|max:255',
            'customer_wa' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'payment_method' => 'required|in:transfer,cod',
            'shipping_cost' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:baru,diproses',
            'items' => 'required|json',
        ]);

        $items = json_decode($data['items'], true);
        if (!is_array($items) || empty($items)) {
            return response()->json(['ok' => false, 'error' => 'Item pesanan kosong'], 422);
        }

        $cleanItems = [];
        $subtotal = 0;
        foreach ($items as $it) {
            $produkId = (int)($it['produk_id'] ?? 0);
            $variantId = (int)($it['variant_id'] ?? 0);
            $qty = max(1, (int)($it['qty'] ?? 1));

            $nama = '-';
            $variantNama = null;
            $harga = 0;
            $berat = null;

            if ($variantId) {
                $var = ProdukVariant::with('produk')->find($variantId);
                if ($var && (int)$var->produk_id === $produkId) {
                    $nama = $var->produk->nama ?? '-';
                    $variantNama = $var->nama;
                    $harga = (float)$var->harga;
                    $berat = $var->berat;
                }
            } elseif ($produkId) {
                $prod = Produk::find($produkId);
                if ($prod) {
                    $nama = $prod->nama;
                    $harga = (float)$prod->harga;
                    $berat = $prod->berat;
                }
            }

            if ($nama === '-') {
                continue;
            }

            $subtotal += $harga * $qty;
            $cleanItems[] = [
                'produk_id' => $produkId,
                'variant_id' => $variantId ?: null,
                'nama' => $nama,
                'variant_nama' => $variantNama,
                'harga' => $harga,
                'qty' => $qty,
                'berat' => $berat,
            ];
        }

        if (empty($cleanItems)) {
            return response()->json(['ok' => false, 'error' => 'Produk tidak ditemukan pada item'], 422);
        }

        $shippingCost = (float)($request->shipping_cost ?? 0);

        $last = Order::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $orderNumber = 'FRD-' . date('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_number' => $orderNumber,
            'order_source' => $data['order_source'],
            'customer_name' => $data['customer_name'],
            'customer_wa' => $data['customer_wa'],
            'customer_address' => $data['customer_address'] ?? '',
            'items' => $cleanItems,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'grand_total' => $subtotal + $shippingCost,
            'payment_method' => $data['payment_method'],
            'payment_status' => 'pending',
            'status' => $data['status'] ?? 'baru',
        ]);

        return response()->json(['ok' => true, 'order' => $order]);
    }

    public function show(Order $order)
    {
        $banks = Bank::where('is_active', true)->get();
        $itemList = $this->parseItems($order);
        return response()->json([
            'order' => $order,
            'itemList' => $itemList,
            'banks' => $banks,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:baru,diproses,dikirim,selesai,dibatalkan',
            'courier' => 'nullable|string|max:100',
            'tracking_number' => 'nullable|string|max:100',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $order->status;

        DB::transaction(function () use ($order, $data, $oldStatus, $request) {
            if ($data['status'] === 'diproses' && $oldStatus !== 'diproses') {
                $this->adjustStock($order, -1);
            } elseif ($data['status'] === 'dibatalkan' && in_array($oldStatus, ['diproses', 'dikirim'])) {
                $this->adjustStock($order, 1);
            }
            if ($data['status'] === 'dikirim') {
                $data['courier'] = $request->courier;
                $data['tracking_number'] = $request->tracking_number;
            }
            if ($request->filled('shipping_cost')) {
                $data['shipping_cost'] = $request->shipping_cost;
                $data['grand_total'] = $order->subtotal + (float)$request->shipping_cost;
            }
            $order->update($data);
        });

        $order->refresh();

        $result = ['ok' => true, 'message' => 'Pesanan diperbarui'];

        if ($request->wantsJson()) {
            if (in_array($data['status'], ['diproses', 'dikirim', 'selesai', 'dibatalkan'])) {
                $wa = new WhatsAppService();
                $msg = WhatsAppService::statusMessage($data['status'], [
                    'customer_name' => $order->customer_name,
                    'order_number' => $order->order_number,
                    'courier' => $order->courier,
                    'tracking_number' => $order->tracking_number,
                ]);
                $waResult = $wa->send($order->customer_wa, $msg);
                $result['wa_url'] = $waResult['url'] ?? null;
            }
            return response()->json($result);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan ' . $order->order_number . ' → ' . $data['status']);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan dihapus');
    }

    public function confirm(Order $order)
    {
        $itemList = $this->parseItems($order);
        $subTotal = 0;
        foreach ($itemList as &$it) {
            $subTotal += $it['harga'] * $it['qty'];
            $prod = Produk::find($it['produk_id']);
            $stockStatus = '-';
            $stockOk = false;
            if ($it['variant_id']) {
                $var = ProdukVariant::find($it['variant_id']);
                if ($var) {
                    $stockStatus = $var->stok_status;
                    $stockOk = $var->stok_status === 'tersedia' || $var->stok_status === 'terbatas';
                }
            } elseif ($prod) {
                $stockStatus = $prod->stok_status;
                $stockOk = $prod->stok_status === 'tersedia' || $prod->stok_status === 'terbatas';
            }
            $it['stock_status'] = $stockStatus;
            $it['stock_ok'] = $stockOk;
        }
        $banks = Bank::where('is_active', true)->get();
        $grandTotal = $subTotal + (float)$order->shipping_cost;

        return response()->json([
            'order' => $order,
            'itemList' => $itemList,
            'subTotal' => $subTotal,
            'grandTotal' => $grandTotal,
            'banks' => $banks,
        ]);
    }

    private function parseItems(Order $order): array
    {
        $items = is_array($order->items) ? $order->items : [];
        return array_map(function ($it) {
            return [
                'produk_id' => $it['produk_id'] ?? null,
                'variant_id' => $it['variant_id'] ?? null,
                'nama' => $it['nama'] ?? '-',
                'variant_nama' => $it['variant_nama'] ?? null,
                'harga' => (float)($it['harga'] ?? 0),
                'qty' => (int)($it['qty'] ?? 1),
                'berat' => $it['berat'] ?? null,
            ];
        }, $items);
    }

    private function adjustStock(Order $order, int $direction): void
    {
        $items = is_array($order->items) ? $order->items : [];
        foreach ($items as $it) {
            if (!empty($it['variant_id'])) {
                $var = ProdukVariant::find($it['variant_id']);
                if ($var) {
                    $var->stok_status = $direction === -1 ? 'terbatas' : 'tersedia';
                    $var->save();
                }
            } elseif (!empty($it['produk_id'])) {
                $prod = Produk::find($it['produk_id']);
                if ($prod) {
                    $prod->stok_status = $direction === -1 ? 'terbatas' : 'tersedia';
                    $prod->save();
                }
            }
        }
    }
}
