# Laravel Training Playground Notes

This document gathers every trick, command, and concept explored in the `LaravelEgitim` repository so you can turn it into a polished GitHub Wiki. Each section pairs the relevant artisan commands with the reference implementation that already lives in the codebase.

## 1. Bootstrapping the Environment

1. Install a fresh project and generate an app key.

   ```bash
   composer create-project laravel/laravel LaravelEgitim
   cd LaravelEgitim
   cp .env.example .env
   php artisan key:generate
   ```

2. Wire the database credentials inside `.env`, then run the migrations that ship with the repo plus the custom ones under `database/migrations`.

   ```bash
   php artisan migrate
   ```

3. Link the public disk so uploaded images under `storage/app/public/images` become reachable from the browser.

   ```bash
   php artisan storage:link
   ```

4. Start the dev server (or use Sail/Valet if you prefer).

   ```bash
   php artisan serve
   ```

> Tip: keep `php artisan tinker` open to inspect models while trying the CRUD samples in this repo.

## 2. Routing and Controller Patterns

- All HTTP endpoints are declared in `routes/web.php`. The file demonstrates:
  - A parameterized route hitting `ExampleController::show` for `/test/{name}` (see `app/Http/Controllers/ExampleController.php` and `resources/views/example.blade.php`).
  - Named routes for landing pages and forms such as `Route::get('/web', ...)->name('home');`.
  - Grouped middleware usage: the POST handler for `/form-result` is wrapped in the custom `form.guard` middleware so banned keywords can be rejected before the controller runs.
  - A concise REST-ish grouping of demo endpoints for both the query builder (`DatabaseOperationsController`) and Eloquent (`ModelOperationsController`).

When documenting this section for the wiki, include a `route:list --path=...` screenshot plus a table that maps each name to its controller action.

## 3. Blade Layouts, Components, and the Marketing Page

- `resources/views/layouts/site.blade.php` is the primary layout for the `/web` landing page. It loads Google Fonts, defines a modern design system, includes `partials/navigation` and `partials/footer`, and exposes `@yield('content')`.
- `resources/views/pages/home.blade.php` extends that layout, feeds dynamic hero text from `WebPageController::showLandingPage`, loops over the `$features` array, and links back into the interactive demos via `route('form')` and `route('upload.page')`.
- The `welcome.blade.php` page was reworked into a “playground hub” that lists every sample module using cards and calls-to-action so visitors can find the demos quickly.

Screenshot suggestion: capture the hero section plus the navigation toggle to showcase how the partials tie together.

## 4. Guarded Form Flow

1. `FormController` returns a plain Blade view (`resources/views/form.blade.php`) with a textarea and a CSRF token.
2. `app/Http/Middleware/FormSubmissionGuard.php` blocks requests whose `message` field equals the banned keyword `apple`. Create this middleware with:

   ```bash
   php artisan make:middleware FormSubmissionGuard
   ```

3. Register the alias inside `app/Http/Kernel.php` (`'form.guard' => FormSubmissionGuard::class`) so the route declaration can call `Route::middleware('form.guard')...`.
4. The POST handler simply echoes `$request->input('message')`, which keeps the focus on middleware behavior.

Wiki tip: include a sequence diagram that shows Browser → Middleware → Controller, and mention how to surface validation errors via `$errors` if you expand the demo.

## 5. Query Builder Operations

- `app/Http/Controllers/DatabaseOperationsController.php` demonstrates insert, update, delete, and select calls against the `information_entries` table using the `DB` facade.
- The supporting migration is `database/migrations/2025_11_11_174330_create_information_entries_table.php`, which defines `id`, `content`, and timestamps.
- Helpful commands for this module:

  ```bash
  php artisan tinker
  >>> DB::table('information_entries')->get();
  php artisan migrate:fresh --seed   # if you later add seeders
  ```

Document each action with the SQL it produces (via `DB::listen`) if you want deeper insight in the wiki.

## 6. Eloquent CRUD Walkthrough

- `app/Models/InformationEntry.php` locks the table name and fillable fields so mass assignment calls stay explicit.
- `ModelOperationsController` contains methods that mirror the query builder examples but rely on Eloquent helpers such as `find`, `create`, `update`, and `delete`.
- Showcase how returning messages like “Record updated!” helps keep the browser feedback loop tight.

Suggested wiki exercise: invite the reader to swap `InformationEntry::find(2)` for `firstOrFail()` and demonstrate exception handling.

## 7. Contact Request Module

- Migration: `database/migrations/2025_11_16_071936_iletisim.php` creates the `contact_requests` table with `full_name`, `email`, `phone_number`, and `message`.
- Model: `app/Models/ContactRequest.php` exposes those columns through `$fillable`.
- Controller: `app/Http/Controllers/ContactRequestController.php` renders `resources/views/contact.blade.php` and persists submissions with `ContactRequest::create([...])`. After storing, it redirects back with a session flash message (`with('status', ...)`) that Blade displays at the top of the form.
- Routes: both GET and POST live under `/contact` and are named `contact.form` / `contact.submit`.

Expansion idea: add an index table showing stored requests by hooking `ContactRequest::latest()->paginate(10)` into a dashboard route.

## 8. Image Upload and Gallery

- Controller: `app/Http/Controllers/UploadImage.php` exposes `showForm`, `upload`, and `ListImages`.
  - `upload()` validates an `image` input up to 2 MB, stores it on the `public` disk under the `images` directory (`$request->file('file')->store('images', 'public')`), and flashes both a success message and the stored path.
  - `ListImages()` uses `Storage::files('public/images')` to gather uploaded paths and passes them to the gallery view.
- Views:
  - `resources/views/upload.blade.php` contains the multipart form with `@csrf`.
  - `resources/views/list_images.blade.php` loops over `$files` and calls `Storage::url($file)` so thumbnails work once `php artisan storage:link` has been run.
- Storage helpers:

  ```bash
  php artisan storage:link
  php artisan tinker
  >>> Storage::disk('public')->allFiles('images');
  ```

Document a troubleshooting section in the wiki that reminds readers to clear out `storage/app/public/images` if they want a clean slate.

## 9. User Registration Validation

- `app/Http/Controllers/RegisterUser.php` exposes:
  - `index()` → renders `resources/views/register.blade.php`.
  - `register()` → validates `name`, `email`, and `password` (min length 8, `confirmed`, unique on the `users` table), then would normally call `User::create`. The hashing snippet is commented for clarity; highlight it in the wiki so readers remember to `Hash::make($request->password)`.
- Blade view: `resources/views/register.blade.php` shows `$errors` and posts to `route('register.submit')`. Add a `password_confirmation` field if you want to fully satisfy the `confirmed` rule.
- Migration: `database/migrations/2025_11_16_115134_user.php` sketches a `user` table (id, name, unique email, password, timestamps).

Suggested exercise for the wiki: extend this sample to send a welcome email via `php artisan make:mail`.

## 10. Frequently Used Artisan Commands

| Command | Purpose |
| --- | --- |
| `php artisan route:list` | Verify that each named route points to the expected controller method. |
| `php artisan make:controller UploadImage` | Scaffold feature-specific controllers. Add `--invokable` if you only need one action. |
| `php artisan make:model InformationEntry -m` | Generate models alongside their migrations for tight coupling. |
| `php artisan make:middleware FormSubmissionGuard` | Create custom request guards (spam filters, throttles, etc.). |
| `php artisan migrate`, `migrate:fresh`, `migrate:rollback` | Manage schema changes for the modules above. |
| `php artisan storage:link` | Publish the `public` disk so image uploads are web-accessible. |
| `php artisan tinker` | Inspect models, run quick DB calls, or seed demo rows without writing seeders yet. |

Encourage readers to version-control schema and Blade changes together so the tutorial stays reproducible.

## 11. Turning These Notes into a GitHub Wiki

Use the following structure when copying this content into GitHub:

1. **Home** – summarize the playground and link to `/web`, `/form`, `/contact`, `/upload`, `/images`, `/register`.
2. **Routing & Middleware** – reuse Sections 2 and 4, embed screenshots of `routes/web.php` and the middleware alias in `Kernel.php`.
3. **Database Layer** – bundle Sections 5, 6, and 7, adding ERD snippets if desired.
4. **Media & Storage** – adapt Section 8 and include a note about clearing the `public/storage` symlink when deploying.
5. **User Flows** – detail Sections 3 and 9 so designers and backend devs share the same context.
6. **Command Cheat Sheet** – lift Section 10 verbatim for quick reference.

Pair every page with diagrams or screenshots (VS Code, Postman, terminal) to achieve the “visual” wiki vibe you described. Add checklists for future enhancements (emails, pagination, authentication) so the notes double as a roadmap.

