@extends('layouts.app')

@section('title', 'Admin')

@section('content')

         @if(session('success'))
            <div style="background: #d4edda; color: #1b7a31ff; padding: 15px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 10px;">
             <strong>✅ Sucesso:</strong> {{ session('success') }}
            </div>
        @endif


        @if(session('error'))
          <div style="background: #f8d7da; color: #942631ff; padding: 15px; border-radius: 8px; border: 1px solid #f5c6cb; margin-bottom: 10px;">
            <strong>❌ Erro:</strong> {{ session('error') }}
          </div>
        @endif


        @if(session('status'))
          <div style="background: #d1ecf1; color: #106a7aff; padding: 15px; border-radius: 8px; border: 1px solid #bee5eb; margin-bottom: 10px;">
            <strong>🔃 Atualização :</strong> {{ session('status') }}
          </div>
        @endif



  {{-- TOPO --}}
  <section class="hero">
    <h1 class="section-title">Área de Administração</h1>
    <p class="section-text muted">
      Gestão de utilizadores, gatos, pedidos de voluntariado e doações.
    </p>

    <div class="actions">
      <a href="{{ route('admin.voluntarios.index') }}" class="btn btn-outline">Gerir Voluntários</a>
      <a href="{{ route('admin.doacoes.index') }}" class="btn btn-outline">Gerir Doações</a>
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
                @if(auth()->id() !== $u->id)
                    <form action="{{ route('admin.users.updateRole', $u) }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <select name="role" onchange="this.form.submit()">
                            <option value="0" {{ $u->role == 0 ? 'selected' : '' }}>Utilizador</option>
                            <option value="1" {{ $u->role == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $u->role == 2 ? 'selected' : '' }}>Voluntario</option>
                        </select>
                    </form>
                @else
                <span style="font-weight: bold; color: #145b8aff;">Administrador </span>
                @endif
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
  <section class="card mt-16" id="criar-gato-section">
    <div class="actions" style="justify-content:space-between; align-items:center;">
      <h2 class="section-title" style="margin:0;">Criar Gato</h2>
      <p class="section-text muted" style="margin:0;">Adicionar um novo gato ao sistema</p>
    </div>

    <form
      action="{{ route('admin.gatos.store') }}#criar-gato-section"
      method="POST"
      enctype="multipart/form-data"
      class="form mt-16"
    >
      @csrf

      <div class="field">
        <span>Nome</span>
        <input type="text" name="name" value="{{ old('name') }}" required>
      </div>

      <div class="field">
        <span>Data de nascimento</span>
        <input type="date"
               name="data_nascimento"
               max="{{ date('Y-m-d') }}"
               min="{{ date('Y-m-d', strtotime('-50 years')) }}"
               value="{{ old('data_nascimento') }}"
        >
      </div>

    <div class="field">
    <span>Raça</span>
    <input
        type="text"
        name="raca"
        list="lista-racas"
        value="{{ old('raca') }}"
        placeholder="Escreva para pesquisar..."
        required

        style="{{ $errors->has('raca') ? 'border: 2px solid #ff4d4d;' : '' }}"
    >
    <datalist id="lista-racas">
        @foreach($racasDisponiveis as $raca)
            <option value="{{ $raca }}">
        @endforeach
    </datalist>
    @error('raca')
        <div style="color: #363434ff; font-size: 0.85rem; margin-top: 5px; font-weight: bold; display: flex; align-items: center; gap: 5px;">
             {{ $message }}
        </div>
    @enderror
  </div>

      <div class="field">
        <span>Peso</span>
        <input type="number" step="0.01" name="peso" value="{{ old('peso') }}">
      </div>

      <div class="field">
        <span>Foto</span>
        <input type="file" name="foto" accept="image/*">
      </div>

      <div class="field">
        <span>Histórico</span>
        <textarea name="historico" required>{{ old('historico') }}</textarea>
      </div>

      <div class="actions">
        <button type="submit" class="btn btn-primary">Criar Gato</button>
      </div>
    </form>
  </section>

@endsection
