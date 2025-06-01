<!DOCTYPE html>
<html>
<head>
    <title>Genre List</title>
</head>
<body>
    <h1>List of Genres</h1>
    <ul>
        @foreach ($genres as $genre)
            <li>{{ $genre['id'] }} - {{ $genre['name'] }}</li>
        @endforeach
    </ul>
</body>
</html>
