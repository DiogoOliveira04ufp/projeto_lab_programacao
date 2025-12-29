<nav class="navbar navbar-expand-lg bg-light border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">Gatil</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('quem_somos') }}">Quem Somos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('gatos') }}">Gatos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('doacoes') }}">Doações</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('avaliacoes') }}">Avaliações</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contactos') }}">Contactos</a></li>
      </ul>
    </div>
  </div>
</nav>
