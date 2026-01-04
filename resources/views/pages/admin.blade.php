@extends('layouts.app')

@section('title', 'Admin')

@section('content')

  {{-- TOPO --}}
  <section class="hero">
    <h1 class="section-title">Área de Administração</h1>
    <p class="section-text muted">
      Gestão de utilizadores e gatos do sistema.
    </p>

    <div class="actions">
      <a href="{{ route('home') }}" class="btn btn-outline">Voltar ao site</a>
    </div>
  </section>

  {{-- UTILIZADORES --}}
  <section class="card mt-16">
    <h2 class="section-title">Utilizadores</h2>

    <table style="width:100%; border-collapse:collapse; margin-top:12px;">
      <thead style="background:rgba(0,0,0,.03);">
        <tr>
          <th style="padding:8px;">ID</th>
          <th style="padding:8px;">Nome</th>
          <th style="padding:8px;">Email</th>
          <th style="padding:8px;">Papel</th>
          <th style="padding:8px;">Criado</th>
          <th style="padding:8px;">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr style="border-top:1px solid var(--border);">
            <td style="padding:8px;">{{ $u->id }}</td>
            <td style="padding:8px;">{{ $u->name }}</td>
            <td style="padding:8px;">{{ $u->email }}</td>
            <td style="padding:8px;">
              <form action="{{ route('admin.users.updateRole', $u) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="role" onchange="this.form.submit()">
                  <option value="0" {{ $u->role == 0 ? 'selected' : '' }}>Utilizador</option>
                  <option value="1" {{ $u->role == 1 ? 'selected' : '' }}>Admin</option>
                </select>
              </form>
            </td>
            <td style="padding:8px;">{{ $u->created_at->format('Y-m-d') }}</td>
            <td style="padding:8px;">
              <form
                action="{{ route('admin.users.destroy', $u->id) }}"
                method="POST"
                onsubmit="return confirm('Eliminar este utilizador?');"
              >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-16">
      {{ $users->links() }}
    </div>
  </section>

  {{-- GATOS --}}
  <section class="card mt-16">
    <h2 class="section-title">Gatos</h2>

    <table style="width:100%; border-collapse:collapse; margin-top:12px;">
      <thead style="background:rgba(0,0,0,.03);">
        <tr>
          <th style="padding:8px;">ID</th>
          <th style="padding:8px;">Nome</th>
          <th style="padding:8px;">Raça</th>
          <th style="padding:8px;">Peso</th>
          <th style="padding:8px;">Criado</th>
          <th style="padding:8px;">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($gatos as $g)
          <tr style="border-top:1px solid var(--border);">
            <td style="padding:8px;">{{ $g->id }}</td>
            <td style="padding:8px;">{{ $g->name }}</td>
            <td style="padding:8px;">{{ $g->raca }}</td>
            <td style="padding:8px;">{{ $g->peso }}</td>
            <td style="padding:8px;">{{ $g->created_at->format('Y-m-d') }}</td>
            <td style="padding:8px;">
              <form
                action="{{ route('admin.gatos.destroy', $g->id) }}"
                method="POST"
                onsubmit="return confirm('Eliminar este gato?');"
              >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-16">
      {{ $gatos->links() }}
    </div>
  </section>

  {{-- CRIAR GATO --}}
  <section class="card mt-16">
    <h2 class="section-title">Criar Gato</h2>

    <form
      action="{{ route('admin.gatos.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="form"
    >
      @csrf

      <div class="field">
        <span>Nome</span>
        <input type="text" name="name" required>
      </div>

      <div class="field">
        <span>Data de nascimento</span>
        <input type="date" name="data_nascimento">
      </div>

      <div class="field">
        <span>Raça</span>
        <input type="text" name="raca">
      </div>

      <div class="field">
        <span>Peso</span>
        <input type="number" step="0.01" name="peso">
      </div>

      <div class="field">
        <span>Foto</span>
        <input type="file" name="foto" accept="image/*">
      </div>

      <div class="field">
        <span>Histórico</span>
        <textarea name="historico"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">
        Criar Gato
      </button>
    </form>
  </section>

@endsection
