@extends('layouts.site')

@section('title', 'Laravel Training Playground')

@section('content')
    <section class="hero" id="hero">
        <div class="hero__inner">
            <div>
                <p class="section__pretitle">Playground Release</p>
                <h1 class="hero__title">{{ $headline }}</h1>
                <p class="hero__text">{{ $subheading }} Dive into a curated, modern landing experience where every Laravel demo is only a scroll away.</p>
                <div class="hero__actions">
                    <a href="#capabilities" class="btn btn--primary">Explore Modules</a>
                    <a href="{{ url('/') }}" class="btn btn--ghost">Back to Welcome Hub</a>
                </div>
            </div>
            <div>
                <div class="highlight">
                    <div>
                        <h3>Why this layout?</h3>
                        <p>Sections split across reusable Blade components showcase a realistic project structure that is easy to extend.</p>
                    </div>
                    <div class="stats">
                        <div class="stat">
                            <div class="stat__value">05+</div>
                            <p>Feature sections</p>
                        </div>
                        <div class="stat">
                            <div class="stat__value">08</div>
                            <p>Reusable components</p>
                        </div>
                        <div class="stat">
                            <div class="stat__value">∞</div>
                            <p>Learning potential</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--light" id="capabilities">
        <div class="section__inner">
            <p class="section__pretitle">Capabilities</p>
            <h2 class="section__title">Built with modular Blade sections</h2>
            <p class="section__subtitle">Navigation, footer, and content blocks now live in dedicated files under <code>resources/views/pages</code> for easier maintenance and reusability.</p>

            @php
                $features = [
                    ['title' => 'Reusable Layout', 'copy' => 'A single layout handles typography, colors, scripts, and shared navigation logic.', 'badge' => 'LX'],
                    ['title' => 'Modern Palette', 'copy' => 'Soft gradients, muted backgrounds, and tactile cards keep things current.', 'badge' => 'UI'],
                    ['title' => 'Mobile Ready', 'copy' => 'Navigation collapses, grids stack, and touch targets stay large on any device.', 'badge' => 'RWD'],
                    ['title' => 'Project Structure', 'copy' => 'Pages live under /pages while partials (nav/footer) sit in /partials for clarity.', 'badge' => 'FS'],
                ];
            @endphp

            <div class="card-grid">
                @foreach ($features as $feature)
                    <article class="card">
                        <div class="card__icon">{{ $feature['badge'] }}</div>
                        <h3>{{ $feature['title'] }}</h3>
                        <p>{{ $feature['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="showcase">
        <div class="section__inner">
            <p class="section__pretitle">Showcase</p>
            <h2 class="section__title">Sections designed for storytelling</h2>
            <p class="section__subtitle">Blend hero statements, feature grids, statistic callouts, and CTA banners to craft a narrative around your Laravel features.</p>

            <div class="highlight">
                <div>
                    <h3>Hero + CTA Banner</h3>
                    <p>Use the hero component to drop in dynamic text, then guide visitors toward your form demos or uploads module with vibrant CTAs.</p>
                </div>
                <div>
                    <h3>Statistics that matter</h3>
                    <p>Small stat cards highlight milestones—active users, stored uploads, processed forms—adding credibility to the playground.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--light" id="contact">
        <div class="section__inner">
            <p class="section__pretitle">Next Steps</p>
            <h2 class="section__title">Ready to build your own?</h2>
            <p class="section__subtitle">Jump into the guarded form to test validation, upload images to the gallery, or extend this page with your own sections. Every component is wired for growth.</p>
            <div class="hero__actions" style="margin-top: 2rem;">
                <a href="{{ route('form') }}" class="btn btn--primary">Try the Form Guard</a>
                <a href="{{ route('upload.page') }}" class="btn btn--ghost">Upload Files</a>
            </div>
        </div>
    </section>
@endsection
