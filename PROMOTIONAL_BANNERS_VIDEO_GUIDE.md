# Promotional Banners with Video Support

## Overview
The promotional banners system now supports both **images** and **videos**, giving you more flexibility to create engaging marketing campaigns on your homepage.

## Features

### 1. **Media Type Selection**
Choose between:
- **Image Banner**: Traditional static image banners
- **Video Banner**: Dynamic video content (uploaded files or external URLs)

### 2. **Video Options**

#### A. Upload Video Files
- Supported formats: **MP4**, **WebM**, **OGG**
- Maximum file size: **50MB**
- Recommended: MP4 format for best browser compatibility
- Videos are stored in `storage/promotional-banners/videos/`

#### B. External Video URLs
- **YouTube**: Paste any YouTube video URL
  - Example: `https://www.youtube.com/watch?v=VIDEO_ID`
  - Example: `https://youtu.be/VIDEO_ID`
- **Vimeo**: Paste any Vimeo video URL
  - Example: `https://vimeo.com/VIDEO_ID`

### 3. **Video Settings**

#### Autoplay
- **Enabled**: Video starts playing automatically when page loads
- **Disabled**: User must click play button
- **Recommendation**: Enable for background videos, disable for content videos

#### Loop
- **Enabled**: Video repeats continuously
- **Disabled**: Video plays once and stops
- **Recommendation**: Enable for promotional background videos

#### Muted
- **Enabled**: Video starts with sound off
- **Disabled**: Video starts with sound on
- **Recommendation**: Always enable for autoplay videos (browsers require this)

#### Show Controls
- **Enabled**: Display play/pause, volume, and fullscreen controls
- **Disabled**: Hide video controls
- **Recommendation**: Enable for content videos, disable for background videos

### 4. **Video Thumbnail**
- Upload a custom thumbnail image shown before video loads
- Improves perceived loading speed
- Recommended size: 1920x823px (21:9 aspect ratio)

## How to Create a Video Banner

### Step 1: Navigate to Admin Panel
1. Log in to your admin panel at `/admin`
2. Go to **Homepage Management** → **Promotional Banners**
3. Click **Create Promotional Banner**

### Step 2: Select Media Type
1. In the **Media Type** section, select **Video Banner**

### Step 3: Add Video Content

#### Option A: Upload Video File
1. In the **Banner Video** section, click **Video File**
2. Upload your video file (MP4, WebM, or OGG)
3. Optionally, upload a **Video Thumbnail** for better loading experience

#### Option B: Use External Video
1. In the **Banner Video** section, find **Or External Video URL**
2. Paste your YouTube or Vimeo video URL
3. The system will automatically embed the video

### Step 4: Configure Video Settings
1. In the **Video Settings** section:
   - **Autoplay**: ✅ Enable for background videos
   - **Loop**: ✅ Enable for continuous playback
   - **Muted**: ✅ Enable (required for autoplay)
   - **Show Controls**: ✅ Enable if users should control playback

### Step 5: Add Content Overlay (Optional)
Just like image banners, you can add text overlay on videos:
- **Small Title**: e.g., "NEW ARRIVAL"
- **Main Title**: e.g., "Summer Collection 2025"
- **Description**: Brief promotional text
- **Button Text**: e.g., "SHOP NOW"
- **Button Link**: Where the button should link to

### Step 6: Configure Display Settings
1. **Banner Position**: Choose where to display
   - After Featured Products
   - After Customer Reviews
   - Before Footer
2. **Display Order**: Set priority (lower numbers appear first)
3. **Scheduling**: Set start/end dates (optional)
4. **Active**: Toggle to enable/disable

### Step 7: Save
Click **Create** to save your video banner!

## Best Practices

### Video File Optimization
1. **Resolution**: 1920x1080 (Full HD) or 1920x823 (21:9 aspect ratio)
2. **Duration**: 10-30 seconds for promotional videos
3. **File Size**: Keep under 10MB for fast loading
4. **Compression**: Use H.264 codec for MP4 files
5. **Audio**: Consider muting or removing audio track to reduce file size

### Performance Tips
1. **Use Thumbnails**: Always upload a thumbnail for better perceived performance
2. **Lazy Loading**: Videos load only when needed
3. **Mobile Optimization**: Consider shorter videos for mobile users
4. **Autoplay Wisely**: Only autoplay muted videos to avoid annoying users

### Design Recommendations
1. **Text Overlay**: Use high contrast colors for text over video
2. **Safe Zones**: Keep important text away from video edges
3. **Motion**: Ensure video motion doesn't distract from text content
4. **Branding**: Include your logo or brand colors in the video

### Accessibility
1. **Alt Text**: Always provide descriptive alt text
2. **Controls**: Enable controls for content videos
3. **Captions**: Consider adding captions to videos (especially for sound-on videos)

## Technical Details

### Database Fields
- `media_type`: 'image' or 'video'
- `video`: Path to uploaded video file
- `video_url`: External video URL (YouTube/Vimeo)
- `video_thumbnail`: Path to video thumbnail image
- `autoplay`: Boolean
- `loop`: Boolean
- `muted`: Boolean
- `show_controls`: Boolean

### Video Formats
- **MP4**: Best compatibility (recommended)
- **WebM**: Good for modern browsers
- **OGG**: Fallback for older browsers

### External Video Support
- **YouTube**: Automatically extracts video ID and embeds using YouTube iframe API
- **Vimeo**: Automatically extracts video ID and embeds using Vimeo player API
- **Responsive**: Videos maintain 21:9 aspect ratio on all devices

## Examples

### Example 1: Background Video Banner
```
Media Type: Video Banner
Video File: summer-collection.mp4
Autoplay: ✅ Enabled
Loop: ✅ Enabled
Muted: ✅ Enabled
Show Controls: ❌ Disabled

Text Overlay:
- Small Title: "NEW COLLECTION"
- Main Title: "Summer Vibes 2025"
- Button: "EXPLORE NOW"
```

### Example 2: Product Showcase Video
```
Media Type: Video Banner
Video URL: https://www.youtube.com/watch?v=YOUR_VIDEO_ID
Autoplay: ❌ Disabled
Loop: ❌ Disabled
Muted: ❌ Disabled
Show Controls: ✅ Enabled

Text Overlay:
- Main Title: "See Our Products in Action"
- Description: "Watch our latest product demonstration"
```

### Example 3: Promotional Campaign
```
Media Type: Video Banner
Video File: flash-sale.mp4
Video Thumbnail: flash-sale-thumb.jpg
Autoplay: ✅ Enabled
Loop: ✅ Enabled
Muted: ✅ Enabled
Show Controls: ❌ Disabled

Text Overlay:
- Small Title: "FLASH SALE"
- Main Title: "50% OFF"
- Description: "Limited time offer - Shop now!"
- Button: "SHOP SALE"

Scheduling:
- Start Date: 2025-10-15 00:00
- End Date: 2025-10-20 23:59
```

## Troubleshooting

### Video Not Playing
1. **Check file format**: Ensure video is MP4, WebM, or OGG
2. **Check file size**: Ensure video is under 50MB
3. **Check browser**: Some older browsers may not support certain formats
4. **Check autoplay**: Autoplay requires muted=true

### External Video Not Embedding
1. **Check URL format**: Ensure URL is from YouTube or Vimeo
2. **Check video privacy**: Ensure video is public or unlisted (not private)
3. **Check URL**: Copy the full video URL, not shortened versions

### Video Loading Slowly
1. **Optimize file size**: Compress video to reduce file size
2. **Use thumbnail**: Upload a thumbnail for better perceived performance
3. **Consider external hosting**: Use YouTube/Vimeo for large videos

### Text Overlay Not Visible
1. **Check text color**: Ensure good contrast with video background
2. **Check z-index**: Text overlay should be above video
3. **Test on different devices**: Ensure text is readable on mobile

## Support

For additional help or questions about promotional banners with video support, please contact your system administrator.

---

**Last Updated**: October 15, 2025
**Version**: 2.0

