<!DOCTYPE html>
<html lang="en">

<?php
$cards = [
  ["title" => "Mi Card 1"],
  ["title" => "Mi Card 2"],
  ["title" => "Mi Card 3"],
  ["title" => "Mi Card 4", 'card_body' => "Mi body 4"],
]
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel 11</title>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>

<body>
  <div class="text-white p-4 bg-green-500">Hola Mundo</div>
  @foreach($cards as $card)
  <div class="max-w-xs rounded-md shadow mt-4 p-4 mx-auto bg-green-50 hover:translate-x-2 transition-all after:size-4 after:absolute after:top-4 after:right-4 after:bg-green-400 relative after:rounded-full after:animate-ping before:top-4 before:right-4 before:z-50 before:size-4 before:absolute before:bg-green-600 before:rounded-full">
    <h2>{{ $card['title'] }}</h2>
    @if(array_key_exists('card_body', $card))
    <div class="font-bold text-md mt-5 text-green-950">{{$card['card_body']}}</div>
    @endif
  </div>
  @endforeach
</body>

</html>