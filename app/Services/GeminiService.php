<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = $this->resolveApiKey();
        $this->model = config('services.gemini.model', 'gemini-2.0-flash');
    }

    protected function resolveApiKey(): string
    {
        $key = config('services.gemini.api_key');

        if (!empty($key)) {
            return $key;
        }

        $envFile = base_path('.env');
        if (!file_exists($envFile)) {
            return '';
        }

        preg_match('/^GEMINI_API_KEY\s*=\s*"?(.+?)"?\s*$/m', file_get_contents($envFile), $m);

        return $m[1] ?? '';
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    public function generateArticle(string $title, string $keyword): string
    {
        $prompt = <<<PROMPT
Anda adalah asisten penulis konten untuk website pertanian "Fredian Farm" yang menjual bibit kentang unggul.
Buat artikel lengkap dalam bahasa Indonesia dengan judul: "{$title}"
Topik: {$keyword}

Struktur artikel:
1. **Pendahuluan** (2-3 paragraf) - hook pembaca, kenalkan topik
2. **Isi** (3-5 sub-bagian dengan heading h2) - informasi mendalam, tips praktis, data
3. **Kesimpulan** (1 paragraf) - rangkuman dan call-to-action untuk menghubungi Fredian Farm

Ketentuan:
- Min 500 kata, maks 1000 kata
- Bahasa Indonesia yang baik, santai namun profesional
- Sisipkan kata kunci secara natural (1-2% density)
- Gunakan format HTML untuk heading (<h2>) dan paragraf (<p>)
- Jangan gunakan markdown
- PENTING: Jangan tulis ulang judul artikel di dalam isi. Mulai langsung dengan paragraf pendahuluan, tanpa heading yang sama dengan judul dan tanpa tag <h1>.
- Akhiri dengan paragraf ajakan: "Hubungi Fredian Farm untuk informasi lebih lanjut mengenai bibit kentang unggul."
PROMPT;

        return $this->callApi($prompt);
    }

    protected function callApi(string $prompt): string
    {
        if (!$this->isConfigured()) {
            Log::warning('Gemini API key not configured');
            return '';
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

        try {
            $response = Http::timeout(60)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'temperature' => 0.8,
                    'maxOutputTokens' => 4096,
                    'topP' => 0.95,
                ],
            ]);

            if (!$response->successful()) {
                Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return '';
            }

            $data = $response->json();

            return $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        } catch (\Exception $e) {
            Log::error('Gemini API exception: ' . $e->getMessage());
            return '';
        }
    }
}
