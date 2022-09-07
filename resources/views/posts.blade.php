<x-layout> {{--'content' is expected variable in layout file--}}
    @foreach ($posts as $post)  {{--@ is a 'blade' directive--}}
        <article>
            <h1>
                <a href="/posts/{{ $post->id }}">
                    {!! $post->title !!}
                </a>
            </h1>

            <div>
                {{ $post->excerpt }}
            </div>

        </article>
    @endforeach
</x-layout>
