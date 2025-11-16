# Changelog

## [Unreleased]
### Added
- Initial contact request migration, model, controller, and Blade view translated to English with explanatory comments.

### Changed
- Updated the site routes to expose the new `/contact` endpoints.
- Display a flash message after successfully submitting the contact form for easier demos.
- Reworked the `welcome` landing page into an English playground hub that lists every sample flow with descriptive cards and buttons.
- Rebuilt the `/web` marketing page using `layouts/site.blade.php`, shared partials, and `pages/home.blade.php`, then linked it from the welcome hub with a dedicated CTA.
