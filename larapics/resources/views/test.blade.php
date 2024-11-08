<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blade Components</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>  
    <x-alert type="warning" dismissible id="my-id" class="mt-4" role="flash">
        {{$component->icon()}}
        <p class="mb-0">Data has been removed {{ $component->link('Undo') }}</p>
    </x-alert>
    <x-form action="/images" method="POST">
        <input type="text" name="name">
        <button class="submit">Submit</button>
    </x-form>
</body>
</html>