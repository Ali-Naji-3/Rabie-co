<?php

namespace App\Console\Commands;

use App\Services\VideoCompressionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CompressVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:compress 
                            {path? : Path to specific video file (optional)} 
                            {--all : Compress all videos in storage}
                            {--hero : Compress only hero slider videos}
                            {--promo : Compress only promotional banner videos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress and optimize videos for faster web loading';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $compressionService = new VideoCompressionService();

        // Check if FFmpeg is available
        if (!$this->checkFFmpegInstalled()) {
            $this->error('❌ FFmpeg is not installed!');
            $this->info('');
            $this->info('Install FFmpeg:');
            $this->info('  Ubuntu/Debian: sudo apt install ffmpeg');
            $this->info('  macOS: brew install ffmpeg');
            $this->info('');
            $this->info('See INSTALL_FFMPEG.md for detailed instructions.');
            return 1;
        }

        $this->info('🎬 Video Compression Tool');
        $this->info('=========================');
        $this->info('');

        // Specific file
        if ($path = $this->argument('path')) {
            return $this->compressFile($path, $compressionService);
        }

        // All videos
        if ($this->option('all')) {
            return $this->compressAllVideos($compressionService);
        }

        // Hero sliders only
        if ($this->option('hero')) {
            return $this->compressHeroVideos($compressionService);
        }

        // Promotional banners only
        if ($this->option('promo')) {
            return $this->compressPromoVideos($compressionService);
        }

        // No options provided, show help
        $this->info('Usage examples:');
        $this->info('  php artisan videos:compress --all              # Compress all videos');
        $this->info('  php artisan videos:compress --hero             # Compress hero slider videos');
        $this->info('  php artisan videos:compress --promo            # Compress promo videos');
        $this->info('  php artisan videos:compress path/to/video.mp4  # Compress specific video');
        $this->info('');

        return 0;
    }

    /**
     * Check if FFmpeg is installed
     */
    private function checkFFmpegInstalled(): bool
    {
        $ffmpegPath = env('FFMPEG_BINARIES', '/usr/bin/ffmpeg');
        return file_exists($ffmpegPath) && is_executable($ffmpegPath);
    }

    /**
     * Compress a specific file
     */
    private function compressFile(string $path, VideoCompressionService $service): int
    {
        $this->info("📹 Compressing: {$path}");
        
        $result = $service->compressFromStorage($path);

        if ($result) {
            $this->info("✅ Compressed successfully!");
            $this->info("📁 Compressed file: {$result}");
            return 0;
        } else {
            $this->error("❌ Compression failed. Check logs for details.");
            return 1;
        }
    }

    /**
     * Compress all videos
     */
    private function compressAllVideos(VideoCompressionService $service): int
    {
        $this->info('🔍 Finding all videos...');
        $this->info('');

        $heroResult = $this->compressHeroVideos($service);
        $promoResult = $this->compressPromoVideos($service);

        $this->info('');
        $this->info('✨ All videos processed!');

        return ($heroResult === 0 && $promoResult === 0) ? 0 : 1;
    }

    /**
     * Compress hero slider videos
     */
    private function compressHeroVideos(VideoCompressionService $service): int
    {
        $this->info('🎞️  Processing Hero Slider Videos...');
        $this->info('-----------------------------------');

        $videos = Storage::disk('public')->files('hero-sliders/videos');
        $videos = array_filter($videos, function($file) {
            return preg_match('/\.(mp4|webm|ogg)$/i', $file) && 
                   !str_contains($file, '_compressed');
        });

        if (empty($videos)) {
            $this->warn('  No hero slider videos found.');
            return 0;
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($videos as $video) {
            $this->info("  📹 " . basename($video));
            
            $result = $service->compressFromStorage($video);

            if ($result) {
                $this->info("     ✅ Compressed");
                $successCount++;
            } else {
                $this->error("     ❌ Failed");
                $failCount++;
            }
        }

        $this->info('');
        $this->info("  📊 Results: {$successCount} successful, {$failCount} failed");
        $this->info('');

        return $failCount > 0 ? 1 : 0;
    }

    /**
     * Compress promotional banner videos
     */
    private function compressPromoVideos(VideoCompressionService $service): int
    {
        $this->info('🎬 Processing Promotional Banner Videos...');
        $this->info('------------------------------------------');

        $videos = Storage::disk('public')->files('promotional-banners/videos');
        $videos = array_filter($videos, function($file) {
            return preg_match('/\.(mp4|webm|ogg)$/i', $file) && 
                   !str_contains($file, '_compressed');
        });

        if (empty($videos)) {
            $this->warn('  No promotional banner videos found.');
            return 0;
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($videos as $video) {
            $this->info("  📹 " . basename($video));
            
            $result = $service->compressFromStorage($video);

            if ($result) {
                $this->info("     ✅ Compressed");
                $successCount++;
            } else {
                $this->error("     ❌ Failed");
                $failCount++;
            }
        }

        $this->info('');
        $this->info("  📊 Results: {$successCount} successful, {$failCount} failed");
        $this->info('');

        return $failCount > 0 ? 1 : 0;
    }
}
