<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Records CRUD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="container py-5">
@if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif
@yield('content')
</body>
</html>
