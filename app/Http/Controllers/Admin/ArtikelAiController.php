<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GroqService;
use App\Services\GeminiService;
use App\Http\Requests\Admin\AiGenerateTitlesRequest;
use App\Http\Requests\Admin\AiGenerateArticleRequest;
use Mews\Purifier\Facades\Purifier;

class ArtikelAiController extends Controller
{
    public function __invoke(string $action)
    {
        return match ($action) {
            'titles' => $this->generateTitles(app(AiGenerateTitlesRequest::class)),
            'article' => $this->generateArticle(app(AiGenerateArticleRequest::class)),
            default => response()->json(['error' => 'Aksi tidak dikenal'], 404),
        };
    }

    protected function generateTitles(AiGenerateTitlesRequest $request)
    {
        $groq = app(GroqService::class);

        if (!$groq->isConfigured()) {
            return response()->json([
                'error' => 'GROQ_API_KEY belum dikonfigurasi di file .env',
            ], 400);
        }

        $titles = $groq->generateTitles($request->input('keyword'));

        if (empty($titles)) {
            return response()->json([
                'error' => 'Gagal menghasilkan judul. Coba lagi nanti.',
            ], 500);
        }

        return response()->json([
            'titles' => $titles,
        ]);
    }

    protected function generateArticle(AiGenerateArticleRequest $request)
    {
        $gemini = app(GeminiService::class);
        $groq = app(GroqService::class);

        if (!$gemini->isConfigured()) {
            return response()->json([
                'error' => 'GEMINI_API_KEY belum dikonfigurasi di file .env',
            ], 400);
        }

        if (!$groq->isConfigured()) {
            return response()->json([
                'error' => 'GROQ_API_KEY belum dikonfigurasi di file .env',
            ], 400);
        }

        $konten = $gemini->generateArticle(
            $request->input('judul'),
            $request->input('keyword')
        );

        if (empty($konten)) {
            return response()->json([
                'error' => 'Gagal menghasilkan konten artikel. Coba lagi nanti.',
            ], 500);
        }

        $konten = Purifier::clean($konten);
        $metadata = $groq->generateMetadata($konten, $request->input('judul'));

        return response()->json([
            'konten' => $konten,
            'excerpt' => $metadata['excerpt'] ?? '',
            'meta_title' => $metadata['meta_title'] ?? '',
            'meta_description' => $metadata['meta_description'] ?? '',
        ]);
    }
}
