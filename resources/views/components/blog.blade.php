<x-layout>
    <div class="post-list">
        @foreach($posts as $post)
        <div>
            <a href="/blog/{{ $post->id }}"><h2>{{ $post->title }}</h2></a>
        </div>
        @endforeach
    </div>
</x-layout>