<!DOCTYPE html>
<html>
<head>
    <title>Capsule Reveal</title>
</head>
<body>
    <h1>Hey {{ $capsule->user->username }}, your capsule "{{ $capsule->title }}" is now revealed!</h1>
    <p>Message: {{ $capsule->message }}</p>
    <p>Enjoy your memories!</p>
</body>
</html>