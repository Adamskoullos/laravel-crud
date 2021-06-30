<x-layout>
<div class="single-post">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <div class="buttons">
        <a href="/blog" class="button">Back to blog</a>
        <a href="/blog/{{ $post->id }}/edit" class="button">Edit post</a>
        <form id="delete-frm" class="button" action="" method="POST">
            @method('DELETE')
            @csrf
            <button class="">Delete post</button>
        </form>
    </div>
</div>
</x-layout>