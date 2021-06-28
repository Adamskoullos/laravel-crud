<x-header />
<x-nav />
    @foreach($posts as $post)
    <a href="/blog/{{ $post->id }}"><h1>{{ $post->title }}</h1></a>
    <p>{{ $post->excerpt }}</p>
    @endforeach
<x-footer />