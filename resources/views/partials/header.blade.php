<header class="jumbotron text-center">
    <h2><a href="{{ url('/') }}">Test Blog</a></h2>

    @if(count($sessions))
            <h4 class="mt-4">Visitors:</h4>
            <div>
                @foreach($sessions as $session)
                    <span>{{ $session->browser }}: {{ $session->total }}</span>
                    {{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
    @endif
</header>
