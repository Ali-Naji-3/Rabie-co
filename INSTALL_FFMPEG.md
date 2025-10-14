# FFmpeg Installation Guide

## Quick Install

### Ubuntu/Debian (Recommended):
```bash
sudo apt update
sudo apt install -y ffmpeg
```

### Verify Installation:
```bash
ffmpeg -version
ffprobe -version
```

You should see version information if installed correctly.

## Alternative: Manual Installation

If automatic installation doesn't work, try:

```bash
# Add universe repository (if needed)
sudo add-apt-repository universe
sudo apt update

# Install FFmpeg
sudo apt install -y ffmpeg

# Install additional codecs
sudo apt install -y libavcodec-extra
```

## Test Installation

After installation, test with:
```bash
cd /home/naji/Desktop/Rabie-co
php artisan tinker
```

Then in tinker:
```php
$service = new \App\Services\VideoCompressionService();
echo "FFmpeg is ready!";
exit
```

## Configure Paths

Edit `.env` file and add:
```env
FFMPEG_BINARIES=/usr/bin/ffmpeg
FFPROBE_BINARIES=/usr/bin/ffprobe
```

Then clear config:
```bash
php artisan config:clear
```

## For Production Server

If you're on a shared hosting or don't have sudo access:
1. Contact your hosting provider to install FFmpeg
2. Ask them for the FFmpeg binary paths
3. Update the paths in your `.env` file

## Test Compression

After installation, test video compression:
```bash
php artisan tinker
```

```php
$service = new \App\Services\VideoCompressionService();

// This will test if FFmpeg works
$info = $service->getVideoInfo('/path/to/test-video.mp4');
print_r($info);
```

## Troubleshooting

**Problem: Command 'ffmpeg' not found**
- Run: `sudo apt install ffmpeg`
- Verify: `which ffmpeg`

**Problem: Permission denied**
- Run: `sudo chmod +x /usr/bin/ffmpeg`
- Or run installation with sudo

**Problem: Package not found**
- Update repositories: `sudo apt update`
- Try: `sudo apt install software-properties-common`
- Then retry FFmpeg installation

## Without FFmpeg

The system will work without FFmpeg, but videos won't be compressed automatically. You can:
1. Use external tools (Clipchamp, Handbrake) to compress videos before upload
2. Use smaller, pre-compressed video files
3. Rely on external video hosting (YouTube, Vimeo)

---

**Need Help?** The system includes fallback handling - it will work even without FFmpeg, just without automatic compression.

