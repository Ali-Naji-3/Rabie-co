# Vercel Environment Variables Configuration

## Required Environment Variables for Vercel Deployment

Set these environment variables in your Vercel project settings:

### Application Settings
- `APP_NAME`: Your application name
- `APP_ENV`: production
- `APP_KEY`: Generate with `php artisan key:generate --show`
- `APP_DEBUG`: false
- `APP_URL`: Your Vercel domain (e.g., https://your-project.vercel.app)

### Database Settings (if using external database)
- `DB_CONNECTION`: mysql
- `DB_HOST`: Your database host
- `DB_PORT`: 3306
- `DB_DATABASE`: Your database name
- `DB_USERNAME`: Your database username
- `DB_PASSWORD`: Your database password

### Cache Settings
- `CACHE_DRIVER`: file
- `SESSION_DRIVER`: file
- `QUEUE_CONNECTION`: sync

### Mail Settings (if using email)
- `MAIL_MAILER`: smtp
- `MAIL_HOST`: Your SMTP host
- `MAIL_PORT`: 587
- `MAIL_USERNAME`: Your email username
- `MAIL_PASSWORD`: Your email password
- `MAIL_ENCRYPTION`: tls
- `MAIL_FROM_ADDRESS`: Your from email
- `MAIL_FROM_NAME`: Your application name

## How to Set Environment Variables in Vercel

1. Go to your Vercel project dashboard
2. Navigate to Settings > Environment Variables
3. Add each variable with its corresponding value
4. Make sure to set them for Production environment
5. Redeploy your project after adding variables
