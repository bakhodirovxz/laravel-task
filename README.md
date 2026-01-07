# Laravel Task

A small Laravel application scaffolded for tasks and examples. This README provides detailed instructions to get the project running locally, run tests, and work with common features (migrations, seeders, queue, mail, and frontend assets).

**Prerequisites**
- PHP ^8.2
- Composer
- Node.js (recommended LTS, Node >= 18)
- npm or yarn
- A database server (MySQL, PostgreSQL) or SQLite for local development

**Packages & Versions (from repository)**
- Laravel Framework: ^12.0 (see `composer.json`)
- Dev frontend tools: Vite, Tailwind CSS, Alpine.js (see `package.json` devDependencies)

**Default users (created by seeders)**
- Manager — email: manager@company.com, password: secret (role: manager)
- Client — email: client@company.com, password: secret (role: client)

These records are created by the seeders in `database/seeders`.

## Installation (local)

1. Clone the repository and enter the project directory:

```bash
git clone <repo-url>
cd laravel-task
```

2. Install PHP dependencies via Composer:

```bash
composer install
```

3. Create the environment file and set the application key:

On macOS / Linux:

```bash
cp .env.example .env
php artisan key:generate
```

On Windows (PowerShell):

```powershell
copy .env.example .env
php artisan key:generate
```

4. Configure your database in the `.env` file (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD). For SQLite create the file and set `DB_CONNECTION=sqlite`:

```bash
touch database/database.sqlite
```

5. Run database migrations and seed default data:

```bash
php artisan migrate --seed
```

6. Install Node dependencies and build frontend assets:

```bash
npm install
npm run build      # production build
# or for development
npm run dev
```

7. Start the local development server:

```bash
php artisan serve
```

Visit http://127.0.0.1:8000 to view the application.

## Common Development Commands

- Run test suite:

```bash
php artisan test
# or if using Pest directly
./vendor/bin/pest
```

- Run queued jobs (worker):

```bash
php artisan queue:work
```

- Start a scheduler in dev (example):

```bash
php artisan schedule:work
```

- Clear caches:

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Testing

The project includes test scaffolding. Use `php artisan test` to run tests. If you prefer Pest, run `./vendor/bin/pest`.

## Mail & Queues

- Mail: configure `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, and `MAIL_FROM_ADDRESS` in `.env`.
- Queues: set `QUEUE_CONNECTION` in `.env`. For local development you can use `database` or `sync` drivers. Run `php artisan queue:work` to process jobs.

## Logs

Application logs are located in `storage/logs`.

## Project Structure (important paths)

- Application code: `app/`
- HTTP controllers: `app/Http/Controllers`
- Models: `app/Models`
- Migrations: `database/migrations`
- Seeders: `database/seeders`
- Factories: `database/factories`
- Frontend: `resources/js`, `resources/css`

## Troubleshooting

- If migrations fail, check database credentials in `.env` and that the DB server is running.
- If composer install fails due to PHP version, ensure your local PHP matches `composer.json` requirement (PHP ^8.2).

## Optional: Docker (suggested quick setup)

You can run the app with Docker + docker-compose. Example (not included): a minimal `docker-compose.yml` would provide services for `app`, `db` (MySQL/Postgres), and `node` for building assets. If you'd like, I can add a ready-to-use `docker-compose.yml` and Dockerfile.

## Optional: CI (GitHub Actions)

I can also add a GitHub Actions workflow to run `composer install`, `php artisan migrate --env=testing`, and `php artisan test` on pull requests.

---

If you want, I can add a `docker-compose.yml`, Dockerfile, and a GitHub Actions CI workflow next. Tell me which you prefer and I'll add them.

---

If you want Docker support, CI (GitHub Actions), or deployment instructions added, tell me which option you prefer and I'll add it.



## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
