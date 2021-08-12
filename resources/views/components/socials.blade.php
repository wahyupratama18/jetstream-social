<div class="grid grid-cols-1">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @if (Route::has('social.facebook.redirection'))    
    <a href="{{ route('social.facebook.redirection') }}">
        Login dengan Facebook
    </a>
    @endif
    
    @if (Route::has('social.twitter.redirection'))
    <a href="{{ route('social.twitter.redirection') }}">
        Login dengan Twitter
    </a>
    @endif
    
    @if (Route::has('social.linkedin.redirection'))
    <a href="{{ route('social.linkedin.redirection') }}">
        Login dengan LinkedIn
    </a>
    @endif
    
    @if (Route::has('social.google.redirection'))
    <a href="{{ route('social.google.redirection') }}">
        Login dengan Google
    </a>
    @endif
    
    @if (Route::has('social.github.redirection'))
    <a href="{{ route('social.github.redirection') }}">
        Login dengan GitHub
    </a>
    @endif

</div>