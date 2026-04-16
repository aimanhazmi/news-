# News Project (Yii2)

Lightweight news/cms application built on Yii2. Includes admin module, front module, and broadcast layouts.

## Requirements
- PHP 7.4+
- Composer
- MySQL/MariaDB
- Redis (used for locks/sessions)

## Setup
1. Install dependencies:
   - `composer install`
2. Configure environment:
   - Copy `.env.example` to `.env` and adjust values.
   - The app reads `ADMIN_EMAIL`, `REDIS_*` from environment (see `.env.example`).
   - Update DB settings in `config/dev/db.php` and `config/prod/db.php` as needed.
3. Database:
   - Import provided SQL dump(s) like `28.sql` to seed initial data.
4. Serve the app:
   - Configure Nginx/Apache to serve the `web/` directory as document root.
   - Or run a PHP built-in server: `php -S 0.0.0.0:8080 -t web/`

## GitHub Publishing
1. Initialize git (in the project root):
   - `git init`
   - `git add .`
   - `git commit -m "Initial commit"`
2. Create a new GitHub repository (public if you want people to view it).
3. Add remote and push:
   - `git branch -M main`
   - `git remote add origin https://github.com/<YOUR_USERNAME>/<REPO_NAME>.git`
   - `git push -u origin main`

## Notes
- `.gitignore` excludes `vendor/`, runtime caches, editor files, and `.env`.
- Do not commit real secrets. Use `.env` and environment variables for sensitive values.
- The app references `Yii::$app->params['adminEmail']` for contact; set it in `config/params.php`.
