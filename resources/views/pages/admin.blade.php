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
  </section>
@endsection