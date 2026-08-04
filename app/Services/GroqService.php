<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = (string) config('services.groq.api_key', '');
        $this->model = config('services.groq.model', 'llama-3.3-70b-versatile');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    public function generateTitles(string $keyword): array
    {
        $prompt = <<<PROMPT
Anda adalah asisten penulis konten untuk website pertanian "Fredian Farm" yang menjual bibit kentang unggul.
Buatkan 5 judul artikel SEO-friendly dalam bahasa Indonesia tentang: "{$keyword}"

Setiap judul harus:
- Menarik dan mengandung kata kunci relevan
- Panjang 40-70 karakter
- Bernada informatif dan profesional
- Cocok untuk petani kentang di Indonesia

Kembalikan hanya judul-judul dalam format array JSON, tanpa penjelasan tambahan.
Contoh format: ["Judul 1", "Judul 2", ...]
PROMPT;

        $text = $this->callApi($prompt);

        if (empty($text)) {
            return [];
        }

        $json = $this->extractJson($text);

        if (is_array($json)) {
            return $json;
        }

        return [];
    }

    public function generateMetadata(string $konten, string $judul): array
    {
        $prompt = <<<PROMPT
Anda adalah asisten SEO untuk website pertanian "Fredian Farm" yang menjual bibit kentang unggul.
Berdasarkan judul dan konten artikel berikut, buatkan metadata SEO.

Judul: {$judul}

Konten:
{$konten}

Kembalikan hasil dalam format JSON:
{
  "excerpt": "Ringkasan singkat artikel (maks 160 karakter)",
  "meta_title": "Judul SEO-friendly (40-70 karakter) untuk meta title",
  "meta_description": "Deskripsi meta (maks 160 karakter) untuk SEO"
}

Kembalikan HANYA JSON tanpa penjelasan tambahan.
PROMPT;

        $text = $this->callApi($prompt);

        if (empty($text)) {
            return [];
        }

        $result = $this->extractJson($text);

        if (!is_array($result)) {
            return [];
        }

        return [
            'excerpt' => $result['excerpt'] ?? '',
            'meta_title' => $result['meta_title'] ?? '',
            'meta_description' => $result['meta_description'] ?? '',
        ];
    }

    protected function callApi(string $prompt): string
    {
        if (!$this->isConfigured()) {
            Log::warning('Groq API key not configured');
            return '';
        }

        $url = 'https://api.groq.com/openai/v1/chat/completions';

        try {
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 1024,
            ]);

            if (!$response->successful()) {
                Log::error('Groq API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return '';
            }

            $data = $response->json();

            return $data['choices'][0]['message']['content'] ?? '';
        } catch (\Exception $e) {
            Log::error('Groq API exception: ' . $e->getMessage());
            return '';
        }
    }

    protected function extractJson(string $text): ?array
    {
        $text = trim($text);

        if (str_starts_with($text, '[') || str_starts_with($text, '{')) {
            $decoded = json_decode($text, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        preg_match('/```(?:json)?\s*(\[.*?\]|\{.*?\})\s*```/s', $text, $matches);
        if (!empty($matches[1])) {
            $decoded = json_decode($matches[1], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        preg_match('/\[.*?\]/s', $text, $matches);
        if (!empty($matches[0])) {
            $decoded = json_decode($matches[0], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        preg_match('/\{.*?\}/s', $text, $matches);
        if (!empty($matches[0])) {
            $decoded = json_decode($matches[0], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return null;
    }
}
