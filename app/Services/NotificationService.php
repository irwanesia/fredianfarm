<?php

namespace App\Services;

use App\Models\Kontak;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class NotificationService
{
    public function feed(): Collection
    {
        return collect()
            ->merge($this->pesanan())
            ->merge($this->pesan())
            ->sortByDesc('created_at')
            ->values();
    }

    public function count(): int
    {
        return Order::where('status', 'baru')->count()
            + Kontak::where('dibaca', false)->count();
    }

    protected function pesanan(): array
    {
        return Order::where('status', 'baru')
            ->latest()
            ->take(5)
            ->get()
            ->map(function (Order $o) {
                return [
                    'type' => 'pesanan',
                    'title' => 'Pesanan baru — ' . $o->order_number,
                    'subtitle' => $o->customer_name . ' · ' . strtoupper($o->order_source) . ' · Rp ' . number_format((float) $o->grand_total, 0, ',', '.'),
                    'created_at' => $o->created_at,
                    'time' => $this->relativeTime($o->created_at),
                    'url' => route('admin.orders.index', ['status' => 'baru']),
                ];
            })
            ->all();
    }

    protected function pesan(): array
    {
        return Kontak::where('dibaca', false)
            ->latest()
            ->take(5)
            ->get()
            ->map(function (Kontak $k) {
                return [
                    'type' => 'pesan',
                    'title' => 'Pesan baru dari ' . $k->nama,
                    'subtitle' => Str::limit($k->pesan, 60),
                    'created_at' => $k->created_at,
                    'time' => $this->relativeTime($k->created_at),
                    'url' => route('admin.kontak.index'),
                ];
            })
            ->all();
    }

    protected function relativeTime(Carbon $time): string
    {
        $diff = $time->diffInSeconds(now());

        if ($diff < 60) {
            return 'Baru saja';
        }

        $minutes = (int) round($diff / 60);
        if ($minutes < 60) {
            return $minutes . ' menit lalu';
        }

        $hours = (int) round($minutes / 60);
        if ($hours < 24) {
            return $hours . ' jam lalu';
        }

        $days = (int) round($hours / 24);
        return $days . ' hari lalu';
    }
}
