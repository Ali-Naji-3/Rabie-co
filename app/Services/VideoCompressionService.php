<?php

namespace App\Services;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VideoCompressionService
{
    /**
     * Compress and optimize video for web
     *
     * @param string $inputPath - Full path to input video
     * @param string|null $outputPath - Full path for output video (optional)
     * @return string|false - Returns path to compressed video or false on failure
     */
    public function compress(string $inputPath, ?string $outputPath = null)
    {
        try {
            // Generate output path if not provided
            if (!$outputPath) {
                $pathInfo = pathinfo($inputPath);
                $outputPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_compressed.' . $pathInfo['extension'];
            }

            // Initialize FFMpeg
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => env('FFMPEG_BINARIES', '/usr/bin/ffmpeg'),
                'ffprobe.binaries' => env('FFPROBE_BINARIES', '/usr/bin/ffprobe'),
                'timeout'          => 3600, // 1 hour timeout
                'ffmpeg.threads'   => 4,
            ]);

            // Open video file
            $video = $ffmpeg->open($inputPath);

            // Create format with web-optimized settings
            $format = new X264();
            
            // H.264 codec settings for maximum compatibility and compression
            $format->setKiloBitrate(1500) // 1.5 Mbps - good balance of quality and size
                   ->setAudioCodec('aac')
                   ->setAudioKiloBitrate(128);

            // Additional FFMpeg parameters for better compression
            $format->setAdditionalParameters([
                '-preset', 'medium',           // Encoding speed (medium = good quality/speed balance)
                '-crf', '23',                  // Constant Rate Factor (18-28, lower = better quality)
                '-movflags', '+faststart',     // Enable streaming (progressive download)
                '-pix_fmt', 'yuv420p',        // Pixel format for maximum compatibility
                '-profile:v', 'main',          // H.264 profile
                '-level', '4.0',               // H.264 level
                '-vf', 'scale=1920:-2',       // Scale to max 1920px width, maintain aspect ratio
            ]);

            // Save the compressed video
            $video->save($format, $outputPath);

            // Check if compression was successful and file exists
            if (file_exists($outputPath)) {
                $originalSize = filesize($inputPath);
                $compressedSize = filesize($outputPath);
                $compressionRatio = round((1 - ($compressedSize / $originalSize)) * 100, 2);

                Log::info("Video compressed successfully", [
                    'original_size' => $this->formatBytes($originalSize),
                    'compressed_size' => $this->formatBytes($compressedSize),
                    'compression_ratio' => $compressionRatio . '%',
                    'output_path' => $outputPath
                ]);

                return $outputPath;
            }

            return false;

        } catch (\Exception $e) {
            Log::error("Video compression failed: " . $e->getMessage(), [
                'input_path' => $inputPath,
                'output_path' => $outputPath,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Compress video for Laravel Storage
     *
     * @param string $storagePath - Storage path (e.g., 'hero-sliders/videos/video.mp4')
     * @param string $disk - Storage disk (default: 'public')
     * @return string|false - Returns storage path to compressed video or false
     */
    public function compressFromStorage(string $storagePath, string $disk = 'public')
    {
        try {
            $fullPath = Storage::disk($disk)->path($storagePath);
            
            if (!file_exists($fullPath)) {
                Log::error("Video file not found: " . $fullPath);
                return false;
            }

            // Generate compressed filename
            $pathInfo = pathinfo($storagePath);
            $compressedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_compressed.' . $pathInfo['extension'];
            $compressedFullPath = Storage::disk($disk)->path($compressedPath);

            // Compress the video
            $result = $this->compress($fullPath, $compressedFullPath);

            if ($result) {
                return $compressedPath;
            }

            return false;

        } catch (\Exception $e) {
            Log::error("Storage video compression failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Create web-optimized thumbnail from video
     *
     * @param string $videoPath - Full path to video file
     * @param string|null $thumbnailPath - Full path for output thumbnail
     * @param int $atSecond - Which second to capture (default: 1)
     * @return string|false - Returns path to thumbnail or false
     */
    public function createThumbnail(string $videoPath, ?string $thumbnailPath = null, int $atSecond = 1)
    {
        try {
            if (!$thumbnailPath) {
                $pathInfo = pathinfo($videoPath);
                $thumbnailPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_thumb.jpg';
            }

            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => env('FFMPEG_BINARIES', '/usr/bin/ffmpeg'),
                'ffprobe.binaries' => env('FFPROBE_BINARIES', '/usr/bin/ffprobe'),
            ]);

            $video = $ffmpeg->open($videoPath);
            $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds($atSecond));
            $frame->save($thumbnailPath);

            return file_exists($thumbnailPath) ? $thumbnailPath : false;

        } catch (\Exception $e) {
            Log::error("Thumbnail creation failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Get video information
     */
    public function getVideoInfo(string $videoPath)
    {
        try {
            $ffmpeg = FFMpeg::create();
            $ffprobe = $ffmpeg->getFFProbe();
            
            return [
                'duration' => $ffprobe->format($videoPath)->get('duration'),
                'dimensions' => $ffprobe->streams($videoPath)->videos()->first()->getDimensions(),
                'bitrate' => $ffprobe->format($videoPath)->get('bit_rate'),
                'size' => filesize($videoPath),
            ];
        } catch (\Exception $e) {
            Log::error("Failed to get video info: " . $e->getMessage());
            return false;
        }
    }
}

