<x-layout>
<div class="create-form-container">
    <h1>Edit Post</h1>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        <textarea name="body" id="body" placeholder="Enter post content" required>{{ $post->body }}</textarea>
        <button>Add post</button>
    </form>
</div>
</x-layout>