<nav class="site-nav">
    <div class="site-nav__inner">
        <a href="{{ route('home') }}" class="site-nav__brand">Laravel Playground</a>

        <div class="site-nav__links" data-nav-links>
            <a href="#hero">Home</a>
            <a href="#capabilities">Capabilities</a>
            <a href="#showcase">Showcase</a>
            <a href="#contact">Contact</a>
            <a class="site-nav__cta" href="{{ route('register.page') }}">Join Now</a>
        </div>

        <button class="site-nav__toggle" aria-label="Toggle navigation" data-nav-toggle>
            Menu
        </button>
    </div>
</nav>
