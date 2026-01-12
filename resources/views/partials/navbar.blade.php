<nav class="navbar">
  <div class="container navbar-inner">
     <a class="brand" href="{{ route('home') }}">
       Gatil Arca d’Água
     </a>

    <div class="nav">
      <a href="{{ route('quem_somos') }}">Quem Somos</a>
      <a href="{{ route('gatos') }}">Adotar</a>
      <a href="{{ route('doacoes') }}">Doações</a>
      <a href="{{ route('voluntarios') }}">Voluntários</a>
      <a href="{{ route('avaliacoes.index') }}">Avaliações</a>
      <a href="{{ route('contactos') }}">Contactos</a>

      @auth
        @if(auth()->user()->role === 1)
          <a href="{{ route('admin') }}">
            👤 Admin
          </a>
        @endif
        @if(in_array((int) auth()->user()->role, [0, 2]))
        <a href="{{ route('perfil') }}" class="btn">
            👤 Perfil
        </a>
        @endif
      @endauth

      @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="btn btn-outline">Sair</button>
        </form>
      @else
        <a href="{{ route('login') }}">Login</a>
      @endauth
    </div>
  </div>
</nav>
