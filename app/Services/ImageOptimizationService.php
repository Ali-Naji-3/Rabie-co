<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Lightweight image optimization for customer-uploaded review photos.
 *
 * Single responsibility: take an uploaded image, resize + re-encode it to WebP,
 * store it on the public disk, and return the relative path for the DB. Used by
 * BOTH the Filament admin upload and the public submission controller (SSOT —
 * one optimization path, no duplication).
 */
class ImageOptimizationService
{
    /** Longest edge cap in pixels — never upscales smaller images. */
    private const MAX_EDGE = 800;

    /** WebP quality (and JPEG fallback quality). */
    private const QUALITY = 80;

    /**
     * Optimize and store an uploaded image.
     *
     * @return string|null Relative path under the disk (e.g. "customer-reviews/uuid.webp"),
     *                     or null on failure (caller decides how to surface it).
     */
    public function optimizeAndStore(UploadedFile $file, string $directory = 'customer-reviews'): ?string
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());

            // Fit within an 800x800 box, preserve aspect ratio, never upscale.
            $image->scaleDown(width: self::MAX_EDGE, height: self::MAX_EDGE);

            // Prefer WebP; fall back to JPEG when the GD build lacks WebP support.
            if (function_exists('imagewebp')) {
                $extension = 'webp';
                $encoded = $image->toWebp(self::QUALITY);
            } else {
                $extension = 'jpg';
                $encoded = $image->toJpeg(self::QUALITY);
                Log::warning('ImageOptimizationService: GD WebP unavailable, stored JPEG fallback.');
            }

            $path = $directory.'/'.Str::uuid()->toString().'.'.$extension;
            Storage::disk('public')->put($path, (string) $encoded);

            return $path;
        } catch (\Throwable $e) {
            Log::error('ImageOptimizationService failed: '.$e->getMessage(), [
                'directory' => $directory,
            ]);

            return null;
        }
    }
}
