<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait GeneratesPlaceholderImages
{
    protected function generatePlaceholderImage(
        string $folder,
        string $label,
        int $width = 800,
        int $height = 800,
    ): string {
        $image = imagecreatetruecolor($width, $height);

        $palette = [
            [118, 171, 174],
            [10, 41, 71],
            [244, 162, 97],
            [231, 111, 81],
            [42, 157, 143],
        ];
        [$r, $g, $b] = $palette[array_rand($palette)];

        $bg = imagecolorallocate($image, $r, $g, $b);
        imagefill($image, 0, 0, $bg);

        $textColor = imagecolorallocate($image, 255, 255, 255);
        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($label);
        $textHeight = imagefontheight($font);

        imagestring(
            $image,
            $font,
            intdiv($width - $textWidth, 2),
            intdiv($height - $textHeight, 2),
            $label,
            $textColor,
        );

        ob_start();
        imagejpeg($image, null, 85);
        $contents = ob_get_clean();
        imagedestroy($image);

        $path = $folder . '/' . Str::random(24) . '.jpg';
        Storage::disk('public')->put($path, $contents);

        return $path;
    }
}
