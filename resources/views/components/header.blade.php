<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fila Fácil - {{ $titulo }}</title>
  @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
  <header>
    <img src="{{ Vite::asset('resources/assets/logo_nome-day.png') }}" alt="Logo">
  </header>