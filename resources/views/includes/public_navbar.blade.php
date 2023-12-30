
<!-- the w3 classes below are in resources / css / w3.css-->



<!-- dark blue navbar with white text -->
<nav class="navbar navbar-expand-sm  bg-primary navbar-dark justify-content-center">
  <div class="container-fluid">
    <ul class="navbar-nav">
     
     <li class="nav-item active">
        <a class="nav-link" href="{{ route('blog.get.show_blog') }}">Show the blog</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posts links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('posts.get.create_post') }}">Create a post</a>
          <a class="dropdown-item" href="{{ route('posts.get.choose_post') }}">Choose a post</a>
          <a class="dropdown-item" href="{{ route('posts.get.choose_post') }}">Update a post</a>
          <a class="dropdown-item" href="{{ route('posts.get.choose_post') }}">Delete a post</a>
          <a class="dropdown-item" href="{{ route('posts.get.view_posts') }}">View all your posts</a>
        
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Comments links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('comments.get.choose_comment') }}">Choose a comment</a>
          <a class="dropdown-item" href="{{ route('comments.get.choose_comment') }}">Update a comment</a>
          <a class="dropdown-item" href="{{ route('comments.get.choose_comment') }}">Delete a comment</a>
         <a class="dropdown-item" href="{{ route('comments.get.view_comments') }}">View all your comments</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('public.get.index') }}">Site start</a>
      </li>
    </ul>
  </div>
</nav>

