<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --brand-primary: #7f5af0;
                --brand-secondary: #2cb67d;
                --text-dark: #0f172a;
                --text-muted: #64748b;
                --surface: #ffffff;
                --surface-muted: #f8fafc;
                --border: #e2e8f0;
            }

            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                margin: 0;
                background: var(--surface-muted);
                color: var(--text-dark);
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            main {
                min-height: 100vh;
            }

            .site-nav {
                position: sticky;
                top: 0;
                z-index: 20;
                background: rgba(255, 255, 255, 0.95);
                border-bottom: 1px solid var(--border);
                backdrop-filter: blur(8px);
            }

            .site-nav__inner {
                max-width: 1200px;
                margin: 0 auto;
                padding: 1rem 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .site-nav__brand {
                font-weight: 700;
                font-size: 1.15rem;
                color: var(--brand-primary);
            }

            .site-nav__links {
                display: flex;
                gap: 1.5rem;
                align-items: center;
            }

            .site-nav__links a {
                font-weight: 500;
                color: var(--text-muted);
                transition: color 0.2s ease;
            }

            .site-nav__links a:hover {
                color: var(--brand-primary);
            }

            .site-nav__cta {
                background: var(--brand-primary);
                color: #fff;
                padding: 0.6rem 1.25rem;
                border-radius: 999px;
                font-weight: 600;
            }

            .site-nav__toggle {
                display: none;
                background: transparent;
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 0.35rem 0.75rem;
            }

            .hero {
                position: relative;
                overflow: hidden;
                background: radial-gradient(circle at top right, rgba(127, 90, 240, 0.25), transparent 55%),
                    linear-gradient(120deg, #141b2f, #1f2a44);
                color: #fff;
                padding: 7rem 1.5rem 5rem;
            }

            .hero__inner {
                max-width: 1100px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2.5rem;
                align-items: center;
            }

            .hero__title {
                font-size: clamp(2.5rem, 5vw, 3.5rem);
                margin-bottom: 1rem;
            }

            .hero__text {
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.7;
                margin-bottom: 2rem;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                padding: 0.85rem 1.75rem;
                font-weight: 600;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .btn--primary {
                background: var(--brand-primary);
                color: #fff;
                box-shadow: 0 15px 35px rgba(127, 90, 240, 0.35);
            }

            .btn--ghost {
                border: 1px solid rgba(255, 255, 255, 0.25);
                color: #fff;
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .section {
                padding: 5rem 1.5rem;
            }

            .section--light {
                background: var(--surface);
            }

            .section__inner {
                max-width: 1100px;
                margin: 0 auto;
            }

            .section__pretitle {
                text-transform: uppercase;
                letter-spacing: 0.2rem;
                font-size: 0.85rem;
                color: var(--brand-secondary);
                font-weight: 600;
            }

            .section__title {
                font-size: clamp(2rem, 4vw, 2.75rem);
                margin: 0.8rem 0;
            }

            .section__subtitle {
                color: var(--text-muted);
                max-width: 640px;
                line-height: 1.6;
            }

            .card-grid {
                margin-top: 3rem;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1.5rem;
            }

            .card {
                background: var(--surface-muted);
                border: 1px solid var(--border);
                border-radius: 1.25rem;
                padding: 1.75rem;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            }

            .card__icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: grid;
                place-items: center;
                background: rgba(127, 90, 240, 0.1);
                color: var(--brand-primary);
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .highlight {
                margin-top: 4rem;
                background: linear-gradient(135deg, rgba(127, 90, 240, 0.08), rgba(44, 182, 125, 0.08));
                border-radius: 32px;
                padding: 3rem;
                border: 1px solid var(--border);
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 2rem;
                align-items: center;
            }

            .stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 1.5rem;
                margin-top: 2.5rem;
            }

            .stat {
                text-align: center;
                padding: 1.5rem;
                border-radius: 1rem;
                background: var(--surface-muted);
                border: 1px solid var(--border);
            }

            .stat__value {
                font-size: 2rem;
                font-weight: 700;
                color: var(--brand-primary);
            }

            .footer {
                background: #0f172a;
                color: rgba(255, 255, 255, 0.75);
                padding: 2.5rem 1.5rem;
            }

            .footer__inner {
                max-width: 1100px;
                margin: 0 auto;
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
                justify-content: space-between;
                align-items: center;
            }

            @media (max-width: 900px) {
                .site-nav__links {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    padding: 1rem 1.5rem;
                    flex-direction: column;
                    background: rgba(255, 255, 255, 0.98);
                    border-bottom: 1px solid var(--border);
                    display: none;
                }

                .site-nav__links.is-open {
                    display: flex;
                }

                .site-nav__toggle {
                    display: inline-flex;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        @include('partials.navigation')
        <main>
            @yield('content')
        </main>
        @include('partials.footer')
        <script>
            const navToggle = document.querySelector('[data-nav-toggle]');
            const navLinks = document.querySelector('[data-nav-links]');

            if (navToggle && navLinks) {
                navToggle.addEventListener('click', () => {
                    navLinks.classList.toggle('is-open');
                });
            }
        </script>
        @stack('scripts')
    </body>
</html>
