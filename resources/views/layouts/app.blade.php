<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Gatil')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

  @include('partials.navbar')

  <main class="container main">
    @yield('content')
  </main>

  <footer class="footer">
    <div class="container">
      <small>Gatil — Projeto Lab_Prog, UFP</small>
    </div>
  </footer>

</body>
</html>
