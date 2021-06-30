<nav>
    <a href="/" class="logo">Logo</a>
    <ul id="list">
        <li><a href="/" class="tabs @if(\Request::is('/')) active  @endif">Home</a></li>
        <li><a href="/blog" class="tabs 
        {{ Route::currentRouteName() === 'blogPosts' ? 'active' : ''}}
        {{ Route::currentRouteName() === 'post' ? 'active' : ''}}
        {{ Route::currentRouteName() === 'edit' ? 'active' : ''}}">Blog</a></li>
        <li><a href="/blog/create/post" class="tabs {{ Route::currentRouteName() === 'create' ? 'active' : '' }}">Create New Post</a></li>
    </ul>
    <div class="burger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</nav>