<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Gatil')</title>
</head>
<body>
  <header>
    <nav>
      <a href="{{ route('home') }}">Home</a> |
      <a href="{{ route('quem_somos') }}">Quem Somos</a> |
      <a href="{{ route('gatos') }}">Gatos disponíveis</a> |
      <a href="{{ route('voluntarios') }}">Voluntarios</a> |
      <a href="{{ route('doacoes') }}">Doações</a> |
      <a href="{{ route('avaliacoes') }}">Avaliações</a> |
      <a href="{{ route('contactos') }}">Contactos</a> |
    </nav>
    <hr>
  </header>

  <main>
    @yield('content')
  </main>

  <hr>
  <footer>
    <small>Gatil — Projeto Lab_Prog, UFP</small>
  </footer>
</body>
</html>
