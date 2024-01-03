<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>PostShare</title>
</head>

<body>
    @auth
    <div class="dashboard">
        <div class="login-status">
            <p>Congrats you are logged in!</p>
            <form method="post" action="/logout">
                @csrf
                <button>Log out</button>
            </form>
        </div>

        <div class="post-form">
            <h2>Create a new post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content..."></textarea>
                <button type="submit">Save Post</button>
            </form>
        </div>

        @if (count($posts) != 0)
        <div class="post-list">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
            <div class="post-item">
                <h3>{{ $post->title }} by {{$post->user->name}}</h3>
                <p>{{ $post->body }}</p>
                <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                <form action="/delete-post/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    @else
    <div class="auth-form">
        <div class="register-form">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Register</button>
            </form>
        </div>
        
        <div class="login-form">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginemail" type="text" placeholder="email">
                <input name="loginpassword" type="password" placeholder="password">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    @endauth
</body>

</html>