<nav class="navbar">
  <div class="container navbar-inner">
    <a class="brand" href="{{ route('home') }}">Gatil</a>

    <div class="nav">
      <a href="{{ route('quem_somos') }}">Quem Somos</a>
      <a href="{{ route('gatos') }}">Gatos</a>
      <a href="{{ route('doacoes') }}">Doações</a>
      <a href="{{ route('avaliacoes') }}">Avaliações</a>
      <a href="{{ route('contactos') }}">Contactos</a>

      @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="btn btn-outline">Sair</button>
        </form>
      @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('registo') }}">Registo</a>
      @endauth
    </div>
  </div>
</nav>
