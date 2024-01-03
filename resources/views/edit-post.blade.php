<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="edit-post-container">
        <h1>Edit Post</h1>
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{$post->title}}" class="edit-post-input">
            <textarea name="body" class="edit-post-textarea">{{$post->body}}</textarea>
            <button class="edit-post-button">Save Changes</button>
        </form>
    </div>
</body>
</html>