<x-layout> {{--'content' is expected variable in layout file--}}
    @foreach ($posts as $post)  {{--@ is a 'blade' directive--}}
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {!! $post->title !!}
                </a>
            </h1>

            <p>
                <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>

            <div>
                {{ $post->excerpt }}
            </div>

        </article>
    @endforeach
</x-layout>
