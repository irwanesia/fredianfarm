<?php

namespace App\Services;

class WhatsAppService
{
    protected string $driver;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->driver = config('services.whatsapp.driver', 'wa_me');
        $this->apiKey = config('services.whatsapp.api_key');
    }

    public function send(string $phone, string $message): array
    {
        return match ($this->driver) {
            'fonnte' => $this->fonnte($phone, $message),
            'wablas' => $this->wablas($phone, $message),
            default  => $this->waMe($phone, $message),
        };
    }

    public static function cleanPhone(string $phone): string
    {
        $clean = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        } elseif (!str_starts_with($clean, '62')) {
            $clean = '62' . $clean;
        }
        return $clean;
    }

    public static function statusMessage(string $status, array $data): string
    {
        $name = $data['customer_name'] ?? 'Pelanggan';
        $orderNumber = $data['order_number'] ?? '-';

        return match ($status) {
            'diproses' => "Halo {$name}! 👋\n\nPesanan *{$orderNumber}* sedang kami proses.\nMohon ditunggu ya, kami akan infokan jika sudah dikirim. 😊",
            'dikirim' => "Halo {$name}! 👋\n\nPesanan *{$orderNumber}* sudah dikirim melalui *{$data['courier']}* dengan nomor resi:\n{$data['tracking_number']}\n\nSilakan cek status pengiriman secara berkala. Terima kasih! 😊",
            'selesai' => "Halo {$name}! 👋\n\nPesanan *{$orderNumber}* sudah selesai.\nTerima kasih sudah berbelanja di Fredian Farm. Semoga puas dengan produknya! 😊🙏",
            'dibatalkan' => "Halo {$name}! 👋\n\nMohon maaf, pesanan *{$orderNumber}* terpaksa kami batalkan.\nSilakan hubungi kami jika ada pertanyaan lebih lanjut.\nTerima kasih 🙏",
            default => '',
        };
    }

    protected function waMe(string $phone, string $message): array
    {
        $clean = static::cleanPhone($phone);
        return [
            'success' => true,
            'type' => 'wa_me',
            'url' => 'https://wa.me/' . $clean . '?text=' . urlencode($message),
            'response' => null,
        ];
    }

    protected function fonnte(string $phone, string $message): array
    {
        return [
            'success' => false,
            'type' => 'fonnte',
            'url' => null,
            'response' => 'Driver not implemented. Set WA_DRIVER=wa_me or implement Fonnte API.',
        ];
    }

    protected function wablas(string $phone, string $message): array
    {
        return [
            'success' => false,
            'type' => 'wablas',
            'url' => null,
            'response' => 'Driver not implemented. Set WA_DRIVER=wa_me or implement Wablas API.',
        ];
    }
}
