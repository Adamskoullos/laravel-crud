<x-layout>
    <div class="post-list container-fluid">
        <div class="row">
           
                @foreach($posts as $post)
                <div class="post col-12 col-md-6 col-lg-4">
                    <a href="/blog/{{ $post->id }}"><h2>{{ $post->title }}</h2></a>
                </div>
                @endforeach
            
        </div>
    </div>
</x-layout>