<?php

namespace App\Helpers;

class ContentRenderer
{
    public static function render(?string $content): string
    {
        if (empty($content)) return '';
        $trimmed = trim($content);

        if (str_starts_with($trimmed, '{')) {
            $data = json_decode($trimmed, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($data['blocks'])) {
                return implode('', array_map([static::class, 'renderBlock'], $data['blocks']));
            }
        }

        return $trimmed; // Legacy HTML fallback
    }

    public static function getExcerpt(?string $content, int $length = 200): string
    {
        if (empty($content)) return '';
        $trimmed = trim($content);

        if (str_starts_with($trimmed, '{')) {
            $data = json_decode($trimmed, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($data['blocks'])) {
                foreach ($data['blocks'] as $block) {
                    if (in_array($block['type'], ['paragraph', 'quote'])) {
                        $text = strip_tags($block['data']['text'] ?? '');
                        if ($text) return \Illuminate\Support\Str::limit($text, $length);
                    }
                }
            }
        }

        return \Illuminate\Support\Str::limit(strip_tags($trimmed), $length);
    }

    protected static function renderBlock(array $block): string
    {
        $data = $block['data'] ?? [];
        return match ($block['type'] ?? '') {
            'paragraph' => '<p class="mb-4 text-gray-600 leading-relaxed">' . ($data['text'] ?? '') . '</p>',
            'header'    => static::renderHeader($data),
            'quote'     => static::renderQuote($data),
            'list'      => static::renderList($data),
            'image'     => static::renderImage($data),
            'gallery'   => static::renderGallery($data),
            default     => '',
        };
    }

    protected static function renderHeader(array $d): string
    {
        $l = $d['level'] ?? 2;
        $cls = match((int)$l) {
            1 => 'text-3xl font-extrabold text-primary mt-10 mb-4',
            2 => 'text-2xl font-bold text-primary mt-8 mb-3',
            3 => 'text-xl font-bold text-gray-800 mt-6 mb-2',
            default => 'text-lg font-semibold text-gray-800 mt-4 mb-2',
        };
        return "<h{$l} class='{$cls}'>{$d['text']}</h{$l}>";
    }

    protected static function renderQuote(array $d): string
    {
        $html = "<blockquote class='border-l-4 border-secondary bg-primary/5 p-6 rounded-r-2xl my-8 italic text-gray-600 text-lg'>{$d['text']}";
        if (!empty($d['caption'])) $html .= "<footer class='mt-3 text-sm font-semibold text-gray-500 not-italic'>— {$d['caption']}</footer>";
        return $html . '</blockquote>';
    }

    protected static function renderList(array $d): string
    {
        $tag  = ($d['style'] ?? 'unordered') === 'ordered' ? 'ol' : 'ul';
        $cls  = $tag === 'ol' ? 'list-decimal' : 'list-disc';
        $items = implode('', array_map(fn($i) => "<li>" . (is_array($i) ? ($i['content'] ?? '') : $i) . "</li>", $d['items'] ?? []));
        return "<{$tag} class='{$cls} list-inside space-y-1 my-4 pl-4 text-gray-600'>{$items}</{$tag}>";
    }

    protected static function renderImage(array $d): string
    {
        $url     = $d['file']['url'] ?? $d['url'] ?? '';
        $caption = $d['caption'] ?? '';
        $width   = $d['width'] ?? '100';
        $align   = $d['align'] ?? 'center';

        $wStyle = (int)$width < 100 ? "max-width: {$width}%;" : "width: 100%;";
        $aStyle = match($align) {
            'left'   => 'text-align: left;',
            'right'  => 'text-align: right;',
            default  => 'text-align: center;',
        };

        $html = "<figure class='my-8' style='{$aStyle}'><div style='display: inline-block; {$wStyle}'><img src='" . e($url) . "' alt='" . e($caption) . "' class='w-full rounded-2xl shadow-md'></div>";
        if ($caption) $html .= "<figcaption class='text-center text-sm text-gray-500 mt-3 italic'>" . e($caption) . "</figcaption>";
        return $html . '</figure>';
    }

    protected static function renderGallery(array $d): string
    {
        $images = $d['images'] ?? [];
        if (empty($images)) return '';
        $cols    = (int)($d['columns'] ?? 2);
        $ratio   = $d['aspectRatio'] ?? '16/9';
        $colCls  = match($cols) { 1 => 'grid-cols-1', 3 => 'grid-cols-1 md:grid-cols-3', default => 'grid-cols-1 md:grid-cols-2' };
        $arStyle = $ratio === 'auto' ? "height: auto;" : "aspect-ratio: {$ratio}; object-fit: cover;";

        $html    = "<div class='grid {$colCls} gap-4 my-8'>";
        foreach ($images as $img) {
            $url = $img['url'] ?? '';
            $cap = $img['caption'] ?? '';
            $html .= "<figure class='gallery-trigger group relative overflow-hidden rounded-2xl shadow-md bg-gray-100'>";
            $html .= "<img src='" . e($url) . "' alt='" . e($cap) . "' class='w-full transition-transform duration-500 group-hover:scale-105' style='{$arStyle}'>";
            if ($cap) $html .= "<figcaption class='absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-4 text-white text-xs font-medium'>" . e($cap) . "</figcaption>";
            $html .= "</figure>";
        }
        return $html . '</div>';
    }
}
