# MVC Blog Template

# Make the Model
Create the class that works with the db within the `Models` folder. This class works withthe db via collection methods:
```
php artisan make:model BlogPost
```

# Create table for the model

**Note**: Always make the table name the plural of the Model
```
php artisan make:migration create_blog_posts_table
```

Now customise the table columns to suit.

# Migrate the table to the database

```
php artisan migrate
```

> A this point some initial data can be added via `tinker` for testing:

```php
$post = new App\Models\BlogPost;

$post->title = 'The first Post';

$post->excerpt = 'Some text';

$post->body = 'The post body';

$post->save();

```

# Create the Controller for the Model 

Back in the normal terminal, within the project folder create the `Controller` and link to `Model`. We do this by adding `-m` after the controller name and then adding the model name to the end:
```
php artisan make:controller BlogPostController -m BlogPost
```
Add the basic CRUD methods to the controller to be built up later. The above command adds this template automatically:

```php
class BlogPostController extends Controller
{
    
    public function index()
    {
        // show all blog posts
    }

    public function create()
    {
        //show form to create a blog post
    }

   
    public function store(Request $request)
    {
        //store a new post
    }

    public function show(BlogPost $blogPost)
    {
        //show a blog post
    }

    
    public function edit(BlogPost $blogPost)
    {
        //show form to edit the post
    }

    
    public function update(Request $request, BlogPost $blogPost)
    {
        //save the edited post
    }

    
    public function destroy(BlogPost $blogPost)
    {
        //delete a post
    }
}
```

# Add routes to web.php

Add the routes to the route file before building out each workflow:

```php
// Get all posts
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);

// Grab and show specific blog post
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);

// Open the view that contains the create new post form
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);

// Add form data to the db
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']);

// Grab specific post to edit
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); 

// Add form data to db
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); 

// Delete specific post
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); 
```

# Create basic pages and components and test routing

Using the initial data inserted earlier via tinker create the pages and components to test both the routing and data. Use Blade templating for components and views:

**Components**:
1. Header
2. Footer
3. Nav

**Pages**:

1. Home Page
2. Blog Page
3. Single Post page
4. Create New Post Page 

**Note**: The single post page with the delete button is created by the following form and uses the Blade directives `@method('METHOD')`, `@csrf`. We will wire this up later:

```php
<form id="delete-frm" class="" action="" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger">Delete Post</button>
</form>
```
# Read - Grabing all items workflow

User clicks the `Blog` tab, the `index()` method is invoked within the controller: 

```php
// Get all posts
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
```
Inside the controller, the Model `BlogPost` is imported so it can be used:

```php
use App\Models\BlogPost;
```
Now all collection methods can be accesses via the Model class `BlogPost`. The blogposts table is fetched and saved to `$posts`. The view `blog` is returned passing down the blog posts:

```php
public function index()
    {
        $posts = BlogPost::all();
        return view('blog', ['posts' => $posts]);
    }
```
The `blog` view is rendered with access to `$posts`:

```php
<x-header />
<x-nav />
    @foreach($posts as $post)
    <a href="/blog/{{ $post->id }}"><h1>{{ $post->title }}</h1></a>
    <p>{{ $post->excerpt }}</p>
    @endforeach
<x-footer />
```

# Read - grabing a single item workflow

Leading on from above, a user can click on the title of a post to view a single post within its own view. The url includes the post->id which does two things.

1. The spcific post id is passed to the controller so the post can be grabbed from the db
2. The url matches and triggers a controller function

Within `BlogPostController` the `show()` method is invoked. Behind the scenes, the `BlogPost` Model uses the id params to grab the individual post and supplies the post as the response as `$blogpost`, which is passed into the `show()` method and passed down to the view as `post` to be accessed as `$post`: 

```php
/**
 * Display the specified resource.
 *
 * @param  \App\Models\BlogPost  $blogPost
 * @return \Illuminate\Http\Response
 */
public function show(BlogPost $blogPost)
{
    return view('single-post', ['post' => $blogPost]);
}
```

# Create post workflow

The user clicks on the `Create New Post` tab and the url path in the **href** matches the url path in `web.php` routes. This match triggers the `create()` method within `BlogPostController`. This simply returns the view `create.blade.php` which has the create new post form: 

```php
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('create');
}

```
The form is below, the `name` attributes for both the **input** and **texarea** are the hooks to grab the user input once the form is submitted:

```php
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

```
With the same path but with a `POST` method, there is another match within `web.php` to the `store()` method which posts the user data to the database creating another post. Here is the `web.php` route:

```php
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']);

```
The above route invokes the `store()` method within the `BlogPostController`. The below method takes in the request data, creates a new post and save the returned value as $newPost, using the `$newpost->id` to redirect to the new post view:

```php
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $newPost = BlogPost::create([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return redirect('blog/' . $newPost->id);
}
```


# Updating a post workflow

# Deleting a post workflow