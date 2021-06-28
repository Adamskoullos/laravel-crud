<x-header />
<x-nav />
<div class="single-post">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <div>
        <a href="/blog">Back to blog</a>
        <a href="//blog/{{ $post->id }}/edit">Edit post</a>
        <form id="delete-frm" class="" action="" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete post</button>
        </form>
    </div>
</div>
<x-footer />