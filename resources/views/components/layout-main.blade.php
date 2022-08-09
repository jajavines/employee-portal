<!DOCTYPE html>
@props([
  'title' => 'Test Title',
  'pageHeader' => 'Test Header'
])
<html>
    <head>
        <title>{{ $title }}</title>
        <style>
            body {
                color: blue;
            }
        </style>
    </head>
    <body>
        <h1>{{ $pageHeader }}</h1>
        {{ $slot }}
    </body>
</html>