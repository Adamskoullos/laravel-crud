<x-layout>
    <div class="post-list">
        @foreach($posts as $post)
        <a href="/blog/{{ $post->id }}"><h1>{{ $post->title }}</h1></a>
        @endforeach
    </div>
</x-layout>