@extends ('layouts.app')

@section('title', 'Admin')

@section('content')
  <section class="card span-2">
    <h1 class="section-title">Utilizadores</h1>

    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Papel</th>
          <th>Criado em</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>
            <td>{{ $u->created_at->format('Y-m-d') }}</td>
            <td>
              <form action="{{ route('admin.users.updateRole', $u) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <select name="role" onchange="this.form.submit()">
                  <option value="0" {{ $u->role == 0 ? 'selected' : '' }}>Utilizador</option>
                  <option value="1" {{ $u->role == 1 ? 'selected' : '' }}>Admin</option>
                </select>
              </form>

              <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Eliminar este utilizador?');" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-16">
      {{ $users->links() }}
    </div>

    <h2 class="section-title">Gatos</h2>

    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Raça</th>
          <th>Peso</th>
          <th>Criado em</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($gatos as $g)
          <tr>
            <td>{{ $g->id }}</td>
            <td>{{ $g->name }}</td>
            <td>{{ $g->raca }}</td>
            <td>{{ $g->peso }}</td>
            <td>{{ $g->created_at->format('Y-m-d') }}</td>
            <td>
              <form action="{{ route('admin.gatos.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Eliminar este gato?');" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-8">
      {{ $gatos->links() }}
    </div>

    <h2 class="section-title">Criar Gato</h2>
    <form action="{{ route('admin.gatos.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
      @csrf
      <div>
        <label>Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
      </div>
      <div>
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}">
      </div>
      <div>
        <label>Raça</label>
        <input type="text" name="raca" value="{{ old('raca') }}">
      </div>
      <div>
        <label>Peso</label>
        <input type="number" step="0.01" name="peso" value="{{ old('peso') }}">
      </div>
      <div>
        <label>Foto</label>
        <input type="file" name="foto" accept="image/*">
      </div>
      <div>
        <label>Histórico</label>
        <textarea name="historico">{{ old('historico') }}</textarea>
      </div>
      <div>
        <button type="submit" class="btn">Criar Gato</button>
      </div>
    </form>
  </section>
@endsection