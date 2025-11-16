# Laravel Eğitim Playground

Practice-focused Laravel 10 project that demonstrates the most common building blocks you need while teaching Laravel in Turkish or English. Every feature in this playground maps to a hands-on “lesson” (query builder CRUD, Eloquent CRUD, guarded forms, contact requests, image uploads, registration validation, and a marketing landing page). Use this repository to rehearse demos locally, then jump to the wiki-style notes for deep dives.

- **Live Wiki Notes:** English (`Notes.md`) and Turkish (`NotesTR.md`). These will later power the GitHub Wiki; for now read them side-by-side with this README.
- **Tech:** PHP 8.2+, Laravel 10.x, MySQL-compatible database, Blade, Storage facade, Tailored middleware.

## Contents

- [Feature Highlights](#feature-highlights)
- [Quick Start](#quick-start)
- [Key Routes](#key-routes)
- [Artisan Cheat Sheet](#artisan-cheat-sheet)
- [Project Structure](#project-structure)
- [Wiki / Further Reading](#wiki--further-reading)
- [Contributing](#contributing)

## Feature Highlights

- **Landing + Welcome Hub:** `/web` renders a custom marketing layout (`resources/views/layouts/site.blade.php` + partials) while `/` surfaces every exercise as a card grid.
- **Guarded Form Flow:** `/form` + `/form-result` demonstrate CSRF, custom middleware (`FormSubmissionGuard`), and simple request handling.
- **Query Builder CRUD:** `DatabaseOperationsController` shows insert/update/delete/list actions against the `information_entries` table.
- **Eloquent CRUD:** `ModelOperationsController` mirrors the same flows via the `InformationEntry` model.
- **Contact Requests:** `/contact` posts to `ContactRequestController`, storing data with validation-lite UX and flash status messaging.
- **Image Uploads & Gallery:** `/upload` validates images (2 MB limit) and stores them on the `public` disk; `/images` lists thumbnails.
- **User Registration Demo:** `/register` highlights Laravel’s validator rules (`required`, `unique`, `confirmed`) plus proper feedback handling.

Everything above is backed by migrations inside `database/migrations/2025_*` so you can reset the database whenever you need a clean slate.

## Quick Start

```bash
git clone https://github.com/<your-account>/LaravelEgitim.git
cd LaravelEgitim
cp .env.example .env        # or use php -r "copy('.env.example', '.env');"
composer install
php artisan key:generate
php artisan migrate         # runs all demo migrations
php artisan storage:link    # make uploads publicly accessible
php artisan serve
```

Visit `http://127.0.0.1:8000` to see the playground hub. From there you can explore every module, or hit specific endpoints directly (see below).

> **Database note:** if you target older MySQL versions, `AppServiceProvider` already forces `Schema::defaultStringLength(191)` to avoid index length issues.

## Key Routes

| Route | Method | Description |
| --- | --- | --- |
| `/` | GET | Welcome hub linking to each demo. |
| `/web` | GET | Marketing landing page rendered via the new layout + partials. |
| `/test/{name}` | GET | Example of passing parameters to Blade. |
| `/form` | GET/POST | Form demo guarded by `FormSubmissionGuard`. |
| `/add`, `/update`, `/delete`, `/list` | GET | Query builder CRUD examples. |
| `/model-list`, `/model-add`, `/model-update`, `/model-delete` | GET | Eloquent CRUD helpers. |
| `/contact` | GET/POST | Contact request capture and flash messaging. |
| `/upload` | GET/POST | Multipart image upload + validation. |
| `/images` | GET | List uploaded images from storage. |
| `/register` | GET/POST | User registration validation sample. |

View `routes/web.php` if you want to wire additional exercises or rename the existing ones.

## Artisan Cheat Sheet

| Command | Purpose |
| --- | --- |
| `php artisan route:list --path=form` | Inspect specific demo routes. |
| `php artisan make:controller UploadImage` | Scaffold controllers (already used for each module). |
| `php artisan make:model InformationEntry -m` | Pair model + migration when extending demos. |
| `php artisan migrate:fresh` | Reset the database during workshops. |
| `php artisan tinker` | Manually inspect models while presenting CRUD flows. |
| `php artisan storage:link` | Ensure `/storage` images resolve publicly. |

Check `Notes.md` for a much larger table including troubleshooting advice.

## Project Structure

```
app/
├── Http/Controllers/
│   ├── DatabaseOperationsController.php
│   ├── FormController.php
│   ├── ModelOperationsController.php
│   ├── ContactRequestController.php
│   ├── UploadImage.php
│   └── RegisterUser.php
├── Http/Middleware/FormSubmissionGuard.php
└── Models/
    ├── InformationEntry.php
    └── ContactRequest.php
resources/views/
├── layouts/site.blade.php
├── pages/home.blade.php
├── welcome.blade.php
├── form.blade.php
├── contact.blade.php
├── upload.blade.php
├── list_images.blade.php
└── register.blade.php
database/migrations/2025_*   # Tables for each module
```

Each folder is deliberately organized so workshop participants can jump between MVC layers quickly (controllers, models, views share similar names).

## Wiki / Further Reading

- Read the step-by-step notes: [`Notes.md`](Notes.md) (EN) and [`NotesTR.md`](NotesTR.md) (TR).  
- Once the GitHub Wiki is published, these notes will power the visual documentation. Use this README for quick context; use the Wiki for screenshots, diagrams, and extended tutorials.

## Contributing

1. Fork the project, create a topic branch, and keep the commit history clean.
2. Update or extend the notes when you add a new lesson so the Wiki stays in sync.
3. Open a pull request summarizing the new demo or improvement.

Issues and suggestions are welcome—feel free to log ideas for new lessons (authentication, emailing, job queues, etc.) so the playground keeps growing.

