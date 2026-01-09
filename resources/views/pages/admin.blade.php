@extends('layouts.app')

@section('title', 'Admin')

@section('content')

  {{-- TOPO --}}
  <section class="hero">
    <h1 class="section-title">Área de Administração</h1>
    <p class="section-text muted">
      Gestão de utilizadores, gatos e pedidos de voluntariado.
    </p>

    <div class="actions">
      <a href="{{ route('admin.voluntarios.index') }}" class="btn btn-outline"> Gerir Voluntários</a>
    </div>
  </section>

  {{-- UTILIZADORES --}}
  <section class="card mt-16">
    <div class="actions" style="justify-content:space-between; align-items:center;">
      <h2 class="section-title" style="margin:0;">Utilizadores</h2>
      <p class="section-text muted" style="margin:0;">Alterar papel e remover contas</p>
    </div>

    <table style="width:100%; border-collapse:collapse; margin-top:12px;">
      <thead style="background:rgba(0,0,0,.03);">
        <tr>
          <th style="padding:10px; text-align:left;">ID</th>
          <th style="padding:10px; text-align:left;">Nome</th>
          <th style="padding:10px; text-align:left;">Email</th>
          <th style="padding:10px; text-align:left;">Papel</th>
          <th style="padding:10px; text-align:left;">Criado</th>
          <th style="padding:10px; text-align:left;">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr style="border-top:1px solid var(--border);">
            <td style="padding:10px;">#{{ $u->id }}</td>
            <td style="padding:10px;">{{ $u->name }}</td>
            <td style="padding:10px;">{{ $u->email }}</td>
            <td style="padding:10px;">
              <form action="{{ route('admin.users.updateRole', $u) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="role" onchange="this.form.submit()">
                  <option value="0" {{ $u->role == 0 ? 'selected' : '' }}>Utilizador</option>
                  <option value="1" {{ $u->role == 1 ? 'selected' : '' }}>Admin</option>
                  <option value="2" {{ (int)$u->role === 2 ? 'selected' : '' }}>Voluntário</option>
                </select>
              </form>
            </td>
            <td style="padding:10px;">{{ $u->created_at->format('Y-m-d') }}</td>
            <td style="padding:10px;">
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
    <div class="actions" style="justify-content:space-between; align-items:center;">
      <h2 class="section-title" style="margin:0;">Gatos</h2>
      <p class="section-text muted" style="margin:0;">Eliminar registos existentes</p>
    </div>

    <table style="width:100%; border-collapse:collapse; margin-top:12px;">
      <thead style="background:rgba(0,0,0,.03);">
        <tr>
          <th style="padding:10px; text-align:left;">ID</th>
          <th style="padding:10px; text-align:left;">Nome</th>
          <th style="padding:10px; text-align:left;">Raça</th>
          <th style="padding:10px; text-align:left;">Peso</th>
          <th style="padding:10px; text-align:left;">Nascimento</th>
          <th style="padding:10px; text-align:left;">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($gatos as $g)
          <tr style="border-top:1px solid var(--border);">
            <td style="padding:10px;">#{{ $g->id }}</td>
            <td style="padding:10px;">{{ $g->name }}</td>
            <td style="padding:10px;">{{ $g->raca }}</td>
            <td style="padding:10px;">{{ $g->peso }}</td>
            <td style="padding:10px;">{{ $g->data_nascimento }}</td>
            <td style="padding:10px;">
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
    <div class="actions" style="justify-content:space-between; align-items:center;">
      <h2 class="section-title" style="margin:0;">Criar Gato</h2>
      <p class="section-text muted" style="margin:0;">Adicionar um novo gato ao sistema</p>
    </div>

    <form
      action="{{ route('admin.gatos.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="form mt-16"
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

      <div class="actions">
        <button type="submit" class="btn btn-primary">Criar Gato</button>
      </div>
    </form>
  </section>

@endsection
