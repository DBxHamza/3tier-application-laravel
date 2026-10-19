# 3-Tier Laravel Application

A simple live chat built with Laravel, split into three tiers:

| Tier | What | Where |
|------|------|-------|
| Frontend | Blade page + JavaScript (polls every 2s for live updates) | `resources/views/welcome.blade.php`, `resources/js/app.js` |
| Backend | Laravel controllers and JSON API | `app/Http/Controllers`, `routes/api.php` |
| Database | `messages` table (SQLite by default) | `database/migrations` |

## Run it

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open http://127.0.0.1:8000 in two browser tabs and send a message; it appears in both.

## API

- `GET /api/messages` – latest 50 messages
- `POST /api/messages` – `{ "author": "...", "body": "..." }`
- `GET /api/status` – backend and database health
