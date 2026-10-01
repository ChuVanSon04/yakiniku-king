<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $banners = Banner::query()
            ->where('status', true)
            ->where(function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->where('type', 'image')
                        ->whereNotNull('image');
                })->orWhere(function (Builder $query): void {
                    $query->where('type', 'video')
                        ->whereNotNull('video_url');
                });
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $banners->each(function (Banner $banner): void {
            $banner->setAttribute('video_embed_url', $this->youtubeEmbedUrl($banner->video_url));
        });

        return view('home.index', compact('banners'));
    }

    private function youtubeEmbedUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $parsedUrl = parse_url($url);

        if (! is_array($parsedUrl)) {
            return null;
        }

        $host = strtolower($parsedUrl['host'] ?? '');
        $path = $parsedUrl['path'] ?? '';
        $videoId = null;

        if ($host === 'youtu.be') {
            $videoId = explode('/', trim($path, '/'))[0] ?? null;
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com'], true)) {
            parse_str($parsedUrl['query'] ?? '', $query);

            if ($path === '/watch') {
                $videoId = $query['v'] ?? null;
            } elseif (preg_match('#^/(?:embed|shorts|live)/([^/]+)#', $path, $matches) === 1) {
                $videoId = $matches[1];
            }
        }

        if (! is_string($videoId) || preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId) !== 1) {
            return null;
        }

        return 'https://www.youtube-nocookie.com/embed/'.$videoId
            .'?autoplay=1&mute=1&loop=1&playlist='.$videoId.'&playsinline=1&controls=0&rel=0&enablejsapi=1';
    }
}
