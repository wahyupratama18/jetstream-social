<div class="grid grid-cols-1">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @if (in_array('facebook', $driver))
    <a href="{{ route('social.redirection', ['driver' => 'facebook']) }}">
        Login dengan Facebook
    </a>
    @endif
    
    @if (in_array('twitter', $driver))
    <a href="{{ route('social.redirection', ['driver' => 'twitter']) }}">
        Login dengan Twitter
    </a>
    @endif
    
    @if (in_array('linkedin', $driver))
    <a href="{{ route('social.redirection', ['driver' => 'linkedin']) }}">
        Login dengan LinkedIn
    </a>
    @endif
    
    @if (in_array('google', $driver))
    <a href="{{ route('social.redirection', ['driver' => 'google']) }}">
        Login dengan Google
    </a>
    @endif
    
    @if (in_array('github', $driver))
    <a href="{{ route('social.redirection', ['driver' => 'github']) }}">
        Login dengan GitHub
    </a>
    @endif

</div>