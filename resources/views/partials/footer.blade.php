<footer class="footer">
    <div class="footer__inner">
        <p>© {{ now()->year }} Laravel Training Playground. Crafted for rapid learning.</p>
        <div>
            <a href="{{ route('form') }}">Forms</a> ·
            <a href="{{ route('upload.page') }}">Uploads</a> ·
            <a href="{{ route('contact.form') }}">Contact</a>
        </div>
    </div>
</footer>
