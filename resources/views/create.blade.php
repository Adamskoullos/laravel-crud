<x-header />
<x-nav />
<div class="create-form-container">
    <h1>Create New Post Page</h1>
    <form action="" method="POST">
        @csrf
        <input type="text" id="title" name="title" placeholder="Enter title here" required>
        <textarea name="body" id="body" placeholder="Enter post content" required></textarea>
        <button>Add post</button>
    </form>
</div>
<x-footer />