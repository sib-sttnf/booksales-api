{{-- .blade.php tuh default nama filenya --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book List</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <ul>
        @foreach ($books as $book)
            <li>
                {{ $book->title }} - <strong>{{ $book->author->name }}</strong>
            </li>
        @endforeach
    </ul>
</body>
</html>

{{-- harus sama penulisannya di routes/web.php --}}