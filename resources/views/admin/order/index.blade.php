@extends('layouts.admin')
@section('title', 'Pesanan')
@section('page-header-left')
  <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
    <h3 style="margin:0;font-size:1.2rem">Pesanan</h3>
    <form method="GET" style="display:flex;gap:6px;align-items:center">
      <select name="status" class="form-select form-select-sm" style="width:auto" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
      </select>
      <select name="source" class="form-select form-select-sm" style="width:auto" onchange="this.form.submit()">
        <option value="">Semua Sumber</option>
        <option value="wa" {{ request('source') === 'wa' ? 'selected' : '' }}>WA (Website)</option>
        <option value="tiktok" {{ request('source') === 'tiktok' ? 'selected' : '' }}>TikTok</option>
        <option value="shopee" {{ request('source') === 'shopee' ? 'selected' : '' }}>Shopee</option>
        <option value="manual" {{ request('source') === 'manual' ? 'selected' : '' }}>Manual</option>
      </select>
      @if(request('status') || request('source'))
      <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm">Reset</a>
      @endif
    </form>
    <button class="btn btn-primary btn-sm" onclick="openCatat()">+ Catat Pesanan</button>
  </div>
@endsection
@section('content')
<div class="card">
  <div class="">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>Pesanan</th>
          <th>Sumber</th>
          <th>Pelanggan</th>
          <th>Items</th>
          <th>Total</th>
          <th>Pembayaran</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $o)
        <tr>
          <td><strong style="font-size:13px">{{ $o->order_number }}</strong></td>
          <td>
            @php
              $src = $o->order_source ?? 'wa';
              $srcBg = match($src) { 'tiktok' => '#1F1F1F', 'shopee' => '#FFF1E6', 'manual' => '#F3F4F6', default => '#DCFCE7' };
              $srcColor = match($src) { 'tiktok' => '#FFFFFF', 'shopee' => '#F97316', 'manual' => '#6B7280', default => '#16A34A' };
              $srcLabel = match($src) { 'tiktok' => 'TikTok', 'shopee' => 'Shopee', 'manual' => 'Manual', default => 'WA' };
            @endphp
            <span class="badge" style="background:{{ $srcBg }};color:{{ $srcColor }}">{{ $srcLabel }}</span>
          </td>
          <td>
            <div style="font-weight:600;font-size:13px">{{ $o->customer_name }}</div>
            <div style="font-size:11px;color:var(--tblr-secondary)">{{ $o->customer_wa }}</div>
          </td>
          <td style="max-width:200px;font-size:12px">
            @php $items = is_array($o->items) ? $o->items : []; @endphp
            @foreach($items as $it)
              <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                {{ $it['nama'] ?? '-' }}{{ isset($it['variant_nama']) ? ' ('.$it['variant_nama'].')' : '' }} x{{ $it['qty'] ?? 1 }}
              </div>
            @endforeach
          </td>
          <td><strong style="font-size:13px">Rp {{ number_format($o->grand_total, 0, ',', '.') }}</strong></td>
          <td>
            <span class="badge {{ $o->payment_method === 'cod' ? 'bg-purple-lt' : 'bg-blue-lt' }}" style="font-size:10px">
              {{ $o->payment_method === 'cod' ? 'COD' : 'Transfer' }}
            </span>
          </td>
          <td>
            @php
              $s = $o->status;
              $badgeBg = match($s) { 'baru' => '#FEF3C7', 'diproses' => '#EFF6FF', 'dikirim' => '#DCFCE7', 'selesai' => '#F3F4F6', default => '#FEE2E2' };
              $badgeColor = match($s) { 'baru' => '#D97706', 'diproses' => '#2563EB', 'dikirim' => '#16A34A', 'selesai' => '#6B7280', default => '#EF4444' };
              $label = match($s) { 'baru' => 'Baru', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', default => 'Dibatalkan' };
            @endphp
            <span class="badge" style="background:{{ $badgeBg }};color:{{ $badgeColor }}">{{ $label }}</span>
          </td>
          <td style="font-size:11px;color:var(--tblr-secondary)">{{ $o->created_at->format('d/m/Y H:i') }}</td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-ghost dropdown-toggle" data-bs-toggle="dropdown" data-bs-boundary="window">Aksi</button>
              <div class="dropdown-menu dropdown-menu-end">
                @if($o->status === 'baru')
                <a class="dropdown-item" href="#" onclick="openConfirm({{ $o->id }});return false">✅ Konfirmasi</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="confirmStatus({{ $o->id }}, 'diproses', 'Proses pesanan {{ $o->order_number }}?');return false">⚙️ Proses</a>
                @endif
                @if($o->status === 'diproses')
                <a class="dropdown-item" href="#" onclick="openResi({{ $o->id }});return false">🚚 Kirim</a>
                @endif
                @if($o->status === 'dikirim')
                <a class="dropdown-item" href="#" onclick="confirmStatus({{ $o->id }}, 'selesai', 'Selesaikan pesanan {{ $o->order_number }}?');return false">✅ Selesai</a>
                @endif
                @if(!in_array($o->status, ['selesai', 'dibatalkan']))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" onclick="confirmStatus({{ $o->id }}, 'dibatalkan', 'Batalkan pesanan {{ $o->order_number }}?');return false">❌ Batalkan</a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="openWaOrder('{{ $o->order_number }}','{{ $o->customer_wa }}','{{ addslashes($o->customer_name) }}');return false">💬 Chat Pelanggan</a>
                <form method="POST" action="{{ route('admin.orders.destroy', $o) }}" onsubmit="return confirm('Hapus pesanan {{ $o->order_number }}?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger">🗑️ Hapus</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9">
            <div style="text-align:center;padding:60px 0;color:var(--tblr-secondary)">
              <div style="font-size:40px;margin-bottom:12px">📭</div>
              <div style="font-weight:600;margin-bottom:4px">Belum ada pesanan</div>
              <div style="font-size:13px">Pesanan dari customer akan muncul di sini.</div>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($orders->hasPages())
  <div class="card-footer">{{ $orders->links() }}</div>
  @endif
</div>

<!-- CONFIRM MODAL -->
<div class="modal modal-lg fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" id="confirmContent">
      <div class="modal-header"><h5 class="modal-title">Konfirmasi Pesanan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body" id="confirmBody">
        <div style="text-align:center;padding:40px"><div class="spinner-border"></div></div>
      </div>
    </div>
  </div>
</div>

<!-- RESI MODAL -->
<div class="modal fade" id="resiModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Input Pengiriman</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kurir</label>
          <input type="text" id="resiCourier" class="form-control" placeholder="JNE / J&T / Sicepat" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nomor Resi</label>
          <input type="text" id="resiTracking" class="form-control" placeholder="JP0000000000" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="resiSubmitBtn">Simpan & Kirim WA</button>
      </div>
    </div>
  </div>
</div>

<!-- CATAT PESANAN MODAL -->
<div class="modal modal-lg fade" id="catatModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Catat Pesanan dari Platform</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label required">Sumber Pesanan</label>
            <select id="cpSource" class="form-select">
              <option value="tiktok">TikTok</option>
              <option value="shopee">Shopee</option>
              <option value="manual">Manual / Lainnya</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label required">Metode Pembayaran</label>
            <select id="cpPayment" class="form-select">
              <option value="transfer">Transfer</option>
              <option value="cod">COD</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Status</label>
            <select id="cpStatus" class="form-select">
              <option value="baru">Baru</option>
              <option value="diproses">Diproses</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label required">Nama Pelanggan</label>
            <input type="text" id="cpNama" class="form-control" placeholder="Nama lengkap">
          </div>
          <div class="col-md-6">
            <label class="form-label required">Nomor WhatsApp</label>
            <input type="text" id="cpWa" class="form-control" placeholder="08xxxxxxxxxx">
          </div>
          <div class="col-12">
            <label class="form-label">Alamat Pengiriman</label>
            <textarea id="cpAlamat" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
          </div>
        </div>

        <div class="mt-3" style="border-top:1px solid #E5E7EB;padding-top:14px">
          <label class="form-label">Tambah Produk</label>
          <div class="row g-2">
            <div class="col-md-6">
              <select id="cpProduk" class="form-select" onchange="catatProductChanged()">
                <option value="">— Pilih Produk —</option>
                @foreach($produks as $p)
                @php
                  $vars = $p->variants->map(fn($v) => ['id' => $v->id, 'nama' => $v->nama, 'harga' => (float)$v->harga, 'berat' => $v->berat])->values();
                @endphp
                <option value="{{ $p->id }}" data-variants="{{ json_encode($vars) }}" data-harga="{{ $p->harga }}" data-berat="{{ $p->berat }}">{{ $p->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <select id="cpVariant" class="form-select" disabled></select>
            </div>
            <div class="col-md-2">
              <input type="number" id="cpQty" class="form-control" value="1" min="1">
            </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-primary w-100" onclick="catatAddItem()">+</button>
            </div>
          </div>
          <table class="table table-sm mt-2" style="font-size:13px">
            <thead><tr><th>Produk</th><th>Qty</th><th>Total</th><th class="w-1"></th></tr></thead>
            <tbody id="cpItemsBody"></tbody>
          </table>
          <div class="d-flex justify-content-between align-items-center">
            <span style="font-size:12px;color:var(--tblr-secondary)">Subtotal dihitung otomatis dari harga produk</span>
            <strong>Subtotal: <span id="cpSubtotal">Rp 0</span></strong>
          </div>
          <div class="row mt-2">
            <div class="col-md-4 ms-auto">
              <label class="form-label">Ongkos Kirim (Rp)</label>
              <input type="number" id="cpOngkir" class="form-control" value="0" min="0">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="catatSubmitBtn">Simpan Pesanan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
const STATUS_MAP = {
  baru: { bg: '#FEF3C7', color: '#D97706', label: 'Baru' },
  diproses: { bg: '#EFF6FF', color: '#2563EB', label: 'Diproses' },
  dikirim: { bg: '#DCFCE7', color: '#16A34A', label: 'Dikirim' },
  selesai: { bg: '#F3F4F6', color: '#6B7280', label: 'Selesai' },
  dibatalkan: { bg: '#FEE2E2', color: '#EF4444', label: 'Dibatalkan' },
};

const CSRF_TOKEN = '{{ csrf_token() }}';

function ubahStatus(id, status, extra = {}) {
  fetch('/admin/orders/' + id, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN,
    },
    body: JSON.stringify({ status: status, ...extra }),
  })
  .then(r => r.json())
  .then(d => {
    if (d.ok && d.wa_url) {
      window.open(d.wa_url, '_blank');
    }
    if (d.ok) {
      location.reload();
    } else {
      alert(d.message || 'Gagal mengubah status');
      location.reload();
    }
  })
  .catch(() => {
    alert('Terjadi kesalahan. Coba lagi.');
    location.reload();
  });
}

function confirmStatus(id, status, message) {
  if (!confirm(message)) return;
  ubahStatus(id, status);
}

var resiOrderId = null;

function openResi(id) {
  resiOrderId = id;
  document.getElementById('resiCourier').value = '';
  document.getElementById('resiTracking').value = '';
  new tabler.Modal(document.getElementById('resiModal')).show();
}

document.addEventListener('DOMContentLoaded', function() {
  var btn = document.getElementById('resiSubmitBtn');
  if (btn) {
    btn.addEventListener('click', function() {
      var courier = document.getElementById('resiCourier').value.trim();
      var tracking = document.getElementById('resiTracking').value.trim();
      if (!courier || !tracking) {
        alert('Lengkapi kurir dan nomor resi');
        return;
      }
      tabler.Modal.getInstance(document.getElementById('resiModal')).hide();
      ubahStatus(resiOrderId, 'dikirim', { courier: courier, tracking_number: tracking });
    });
  }
});

function openWaOrder(orderNumber, wa, name) {
  let waClean = wa.replace(/[^0-9]/g, '');
  if (waClean.startsWith('0')) waClean = '62' + waClean.slice(1);
  const msg = 'Halo ' + name + '! 👋\n\nKami terima pesanan Anda *' + orderNumber + '*.\nAda yang bisa kami bantu?';
  window.open('https://wa.me/' + waClean + '?text=' + encodeURIComponent(msg), '_blank');
}

function openConfirm(id) {
  const modal = new tabler.Modal(document.getElementById('confirmModal'));
  modal.show();
  document.getElementById('confirmBody').innerHTML = '<div style="text-align:center;padding:40px"><div class="spinner-border"></div></div>';

  fetch('/admin/orders/' + id + '/confirm')
    .then(r => r.json())
    .then(d => renderConfirm(d, id))
    .catch(() => {
      document.getElementById('confirmBody').innerHTML = '<div style="text-align:center;padding:40px;color:#EF4444">Gagal memuat data pesanan</div>';
    });
}

function renderConfirm(d, id) {
  const esc = v => String(v ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  const o = d.order;
  const items = d.itemList || [];
  const banks = d.banks || [];
  const subTotal = d.subTotal || 0;
  let itemsHtml = '';
  let allStockOk = true;
  items.forEach(it => {
    const icon = it.stock_ok ? '✅' : '⚠️';
    if (!it.stock_ok) allStockOk = false;
    const name = esc(it.nama) + (it.variant_nama ? ' (' + esc(it.variant_nama) + ')' : '');
    itemsHtml += `<tr>
      <td style="font-size:13px">${name}</td>
      <td style="font-size:13px">${Number(it.qty)}</td>
      <td style="font-size:13px">Rp ${Number(it.harga).toLocaleString('id-ID')}</td>
      <td style="font-size:13px;color:${it.stock_ok ? '#16A34A' : '#EF4444'}">${icon} ${esc(it.stock_status) || '-'}</td>
    </tr>`;
  });

  const body = document.getElementById('confirmBody');
  const waNumber = '{{ \App\Models\Setting::getValue("NOMOR_WA", "6281234567890") }}';
  const waClean = waNumber.replace(/[^0-9]/g, '');

  body.innerHTML = `
    <div style="margin-bottom:16px;padding:14px;background:#F9FAFB;border-radius:10px;font-size:13px;line-height:1.8">
      <strong>${esc(o.customer_name)}</strong><br>
      📞 ${esc(o.customer_wa)}<br>
      📍 ${esc(o.customer_address)}<br>
      🆔 ${esc(o.order_number)} · ${esc(o.created_at)}<br>
      💳 ${o.payment_method === 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank'}
    </div>
    <table class="table table-sm" style="font-size:13px">
      <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Stok</th></tr></thead>
      <tbody>${itemsHtml}</tbody>
    </table>
    <div style="font-size:12px;font-weight:600;margin-bottom:14px;color:${allStockOk ? '#16A34A' : '#EF4444'}">
      ${allStockOk ? '✅ Stok tersedia' : '⚠️ Ada item dengan stok perlu dicek'}
    </div>
    <div class="row g-2" style="margin-bottom:14px">
      <div class="col-6">
        <label style="font-size:11px;font-weight:700;color:var(--tblr-secondary);display:block;margin-bottom:4px">Subtotal</label>
        <input class="form-control form-control-sm" value="Rp ${subTotal.toLocaleString('id-ID')}" readonly style="background:#F9FAFB">
      </div>
      <div class="col-6">
        <label style="font-size:11px;font-weight:700;color:var(--tblr-secondary);display:block;margin-bottom:4px">Ongkos Kirim (Rp)</label>
        <input class="form-control form-control-sm" id="cfOngkir" type="number" value="${o.shipping_cost || 0}" min="0" oninput="updatePreview(${id}, ${subTotal})">
      </div>
    </div>
    <div id="cfSummary" style="padding:12px 14px;background:#F9FAFB;border-radius:10px;margin-bottom:14px;font-size:13px;line-height:2">
      <div style="display:flex;justify-content:space-between"><span>Subtotal</span><span>Rp ${subTotal.toLocaleString('id-ID')}</span></div>
      <div style="display:flex;justify-content:space-between"><span>Ongkos Kirim</span><span id="cfOngkirDisplay">Rp ${Number(o.shipping_cost || 0).toLocaleString('id-ID')}</span></div>
      <div style="display:flex;justify-content:space-between;font-weight:700;border-top:1px solid #E5E7EB;padding-top:6px;margin-top:4px">
        <span>Total Pembayaran</span><span id="cfGrandTotal">Rp ${(subTotal + Number(o.shipping_cost || 0)).toLocaleString('id-ID')}</span>
      </div>
    </div>
    ${o.payment_method === 'transfer' && banks.length ? `
    <div style="margin-bottom:14px;font-size:13px;padding:12px 14px;background:#EFF6FF;border-radius:10px">
      <strong style="display:block;margin-bottom:6px">🏦 Transfer ke:</strong>
      ${banks.map(b => '🏦 <strong>' + esc(b.bank_name) + '</strong> — ' + esc(b.account_number) + ' a.n. ' + esc(b.account_holder)).join('<br>')}
    </div>` : o.payment_method === 'cod' ? `
    <div style="margin-bottom:14px;font-size:13px;padding:12px 14px;background:#F3E8FF;border-radius:10px">
      <strong>💵 Pembayaran COD (Bayar di Tempat)</strong><br>
      <span style="color:var(--tblr-secondary)">Pelanggan akan membayar saat barang diterima.</span>
    </div>` : ''}
    <div style="margin-bottom:6px;font-size:12px;font-weight:700;color:var(--tblr-secondary)">📋 PREVIEW PESAN WA</div>
    <textarea id="cfPreview" class="form-control" style="font-size:12px;min-height:200px;font-family:monospace;background:#F9FAFB" readonly></textarea>
    <div style="display:flex;gap:8px;margin-top:12px;justify-content:flex-end">
      <button class="btn btn-ghost btn-sm" data-bs-dismiss="modal">Tutup</button>
      <button class="btn btn-success btn-sm" onclick="sendWaPreview()">📤 Kirim via WA</button>
      <button class="btn btn-primary btn-sm" onclick="copyPreview()">📋 Salin ke Clipboard</button>
    </div>
  `;
  body.dataset.customerWa = o.customer_wa;
  updatePreview(id, subTotal);
}

function updatePreview(id, subTotal) {
  const ongkir = parseInt(document.getElementById('cfOngkir')?.value || 0);
  const grandTotal = subTotal + ongkir;
  const ongkirDisplay = document.getElementById('cfOngkirDisplay');
  const gtDisplay = document.getElementById('cfGrandTotal');
  if (ongkirDisplay) ongkirDisplay.textContent = 'Rp ' + ongkir.toLocaleString('id-ID');
  if (gtDisplay) gtDisplay.textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');

  const preview = document.getElementById('cfPreview');
  if (!preview) return;

  const o = JSON.parse(document.querySelector('[data-order]')?.dataset?.order || '{}');
  const itemsHtml = document.querySelector('#confirmBody table tbody');
  const name = document.querySelector('#confirmBody > div:first-child strong')?.textContent || 'Pelanggan';
  const paymentInfo = document.querySelector('#confirmBody .bg-blue-lt, #confirmBody .bg-purple-lt');

  let itemsStr = '';
  document.querySelectorAll('#confirmBody table tbody tr').forEach(tr => {
    const tds = tr.querySelectorAll('td');
    if (tds.length >= 3) {
      itemsStr += '• ' + tds[0].textContent.trim() + ' x' + tds[1].textContent.trim() + ' = Rp ' + (parseInt(tds[2].textContent.replace(/[^0-9]/g, '')) || 0).toLocaleString('id-ID') + '\n';
    }
  });

  const waNumber = '{{ \App\Models\Setting::getValue("NOMOR_WA", "6281234567890") }}';
  const bankEls = document.querySelectorAll('#confirmBody .bg-blue-lt');
  let bankStr = '';
  document.querySelectorAll('#confirmBody .bg-blue-lt').forEach(b => {
    const text = b.textContent || '';
    const match = text.match(/🏦(.+)/);
    if (match) bankStr += match[0].trim() + '\n';
  });

  let msg = 'Halo ' + name + '! 👋\n\n';
  msg += 'Terima kasih sudah order di Fredian Farm.\n\n';
  msg += '📦 *Pesanan:* ' + (document.querySelector('#confirmBody > div:first-child')?.textContent?.match(/🆔\s*(\S+)/)?.[1] || '') + '\n';
  msg += itemsStr + '\n';
  msg += '💰 *Rincian Biaya:*\n';
  msg += '• Produk: Rp ' + subTotal.toLocaleString('id-ID') + '\n';
  msg += '• Ongkir: Rp ' + ongkir.toLocaleString('id-ID') + '\n';
  msg += '• Total: Rp ' + grandTotal.toLocaleString('id-ID') + '\n\n';

  if ((document.getElementById('confirmBody')?.textContent || '').includes('COD')) {
    msg += '💵 Pembayaran: COD (Bayar di Tempat)\n\n';
    msg += 'Kami akan proses pesanan Anda.\nMohon tunggu konfirmasi ketersediaan barang dan estimasi pengiriman ya.\n\n';
  } else {
    msg += '🏦 *Transfer ke:*\n';
    document.querySelectorAll('#confirmBody .bg-blue-lt').forEach(b => {
      msg += b.textContent.trim() + '\n';
    });
    msg += '\nSetelah transfer, mohon kirimkan bukti transfer ke nomor ini ya.\nKami akan proses setelah pembayaran dikonfirmasi.\n\n';
  }
  msg += 'Terima kasih 😊';

  preview.value = msg;
}

function copyPreview() {
  const preview = document.getElementById('cfPreview');
  if (!preview) return;
  navigator.clipboard.writeText(preview.value).then(() => {
    alert('✅ Pesan konfirmasi berhasil disalin!');
  }).catch(() => {
    preview.select();
    document.execCommand('copy');
    alert('✅ Pesan konfirmasi berhasil disalin!');
  });
}

function sendWaPreview() {
  const msg = document.getElementById('cfPreview')?.value;
  const wa = document.getElementById('confirmBody')?.dataset?.customerWa;
  if (!msg || !wa) return;
  let waClean = wa.replace(/[^0-9]/g, '');
  if (waClean.startsWith('0')) waClean = '62' + waClean.slice(1);
  window.open('https://wa.me/' + waClean + '?text=' + encodeURIComponent(msg), '_blank');
}

let catatItems = [];
let catatSubtotal = 0;

function openCatat() {
  catatItems = [];
  catatSubtotal = 0;
  document.getElementById('cpSource').value = 'tiktok';
  document.getElementById('cpPayment').value = 'transfer';
  document.getElementById('cpStatus').value = 'baru';
  document.getElementById('cpNama').value = '';
  document.getElementById('cpWa').value = '';
  document.getElementById('cpAlamat').value = '';
  document.getElementById('cpOngkir').value = 0;
  document.getElementById('cpQty').value = 1;
  document.getElementById('cpProduk').value = '';
  catatProductChanged();
  renderCatatItems();
  new tabler.Modal(document.getElementById('catatModal')).show();
}

function catatProductChanged() {
  const sel = document.getElementById('cpProduk');
  const opt = sel.selectedOptions[0];
  const variants = opt ? JSON.parse(opt.dataset.variants || '[]') : [];
  const vsel = document.getElementById('cpVariant');
  vsel.innerHTML = '';
  variants.forEach(v => {
    const o = document.createElement('option');
    o.value = v.id;
    o.dataset.harga = v.harga;
    o.dataset.nama = v.nama;
    o.dataset.berat = v.berat || '';
    o.textContent = v.nama + ' — Rp ' + Number(v.harga).toLocaleString('id-ID');
    vsel.appendChild(o);
  });
  vsel.disabled = variants.length === 0;
}

function catatAddItem() {
  const psel = document.getElementById('cpProduk');
  const pOpt = psel.selectedOptions[0];
  if (!pOpt) {
    alert('Pilih produk terlebih dahulu');
    return;
  }
  const vsel = document.getElementById('cpVariant');
  const vOpt = vsel.selectedOptions[0] || null;
  const qty = Math.max(1, parseInt(document.getElementById('cpQty').value) || 1);
  const variantId = vOpt ? parseInt(vOpt.value) : 0;
  const harga = vOpt ? parseFloat(vOpt.dataset.harga) : parseFloat(pOpt.dataset.harga || 0);
  const nama = pOpt.textContent;
  const variantNama = vOpt ? vOpt.dataset.nama : null;
  const berat = vOpt ? (vOpt.dataset.berat || null) : (pOpt.dataset.berat || null);

  const existing = catatItems.find(i => i.produk_id === parseInt(pOpt.value) && i.variant_id === variantId);
  if (existing) {
    existing.qty += qty;
  } else {
    catatItems.push({ produk_id: parseInt(pOpt.value), variant_id: variantId, nama: nama, variant_nama: variantNama, harga: harga, qty: qty, berat: berat });
  }
  document.getElementById('cpQty').value = 1;
  renderCatatItems();
}

function renderCatatItems() {
  const tb = document.getElementById('cpItemsBody');
  tb.innerHTML = '';
  let sub = 0;
  catatItems.forEach((it, idx) => {
    sub += it.harga * it.qty;
    const name = it.nama + (it.variant_nama ? ' (' + it.variant_nama + ')' : '');
    const tr = document.createElement('tr');
    tr.innerHTML = '<td>' + name + '</td><td>' + it.qty + '</td><td>Rp ' + Number(it.harga * it.qty).toLocaleString('id-ID') + '</td><td><button type="button" class="btn btn-sm btn-ghost" onclick="catatRemoveItem(' + idx + ')">✕</button></td>';
    tb.appendChild(tr);
  });
  catatSubtotal = sub;
  document.getElementById('cpSubtotal').textContent = 'Rp ' + sub.toLocaleString('id-ID');
}

function catatRemoveItem(idx) {
  catatItems.splice(idx, 1);
  renderCatatItems();
}

document.addEventListener('DOMContentLoaded', function() {
  const catatBtn = document.getElementById('catatSubmitBtn');
  if (catatBtn) {
    catatBtn.addEventListener('click', function() {
      if (!catatItems.length) {
        alert('Tambah minimal 1 item produk');
        return;
      }
      const payload = {
        order_source: document.getElementById('cpSource').value,
        customer_name: document.getElementById('cpNama').value.trim(),
        customer_wa: document.getElementById('cpWa').value.trim(),
        customer_address: document.getElementById('cpAlamat').value.trim(),
        payment_method: document.getElementById('cpPayment').value,
        status: document.getElementById('cpStatus').value,
        shipping_cost: document.getElementById('cpOngkir').value || 0,
        items: JSON.stringify(catatItems),
      };
      if (!payload.customer_name || !payload.customer_wa) {
        alert('Lengkapi nama dan nomor WhatsApp pelanggan');
        return;
      }
      fetch('/admin/orders', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': CSRF_TOKEN,
        },
        body: JSON.stringify(payload),
      })
      .then(r => r.json())
      .then(d => {
        if (d.ok) {
          tabler.Modal.getInstance(document.getElementById('catatModal')).hide();
          location.reload();
        } else {
          alert(d.error || 'Gagal menyimpan pesanan');
        }
      })
      .catch(() => alert('Terjadi kesalahan. Coba lagi.'));
    });
  }
});
</script>
@endpush
