@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Cabeçalho --}}
  <div class="card mb-6">
    <h1>Pedidos de Voluntariado</h1>
    <p class="text-muted">
      Lista de pedidos submetidos pelos utilizadores
    </p>
  </div>

  {{-- Lista de pedidos --}}
  <div class="card">
    @if($items->count() === 0)
      <p class="text-muted">Ainda não existem pedidos de voluntariado.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Status</th>
            <th>Data</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $v)
            <tr>
              <td>#{{ $v->id }}</td>
              <td>{{ $v->nome }}</td>
              <td>{{ $v->email }}</td>
              <td>
                @if($v->status === 'em_analise')
                  <span class="badge">Em análise</span>
                @elseif($v->status === 'aprovado')
                  <span class="badge success">Aprovado</span>
                @else
                  <span class="badge danger">Rejeitado</span>
                @endif
              </td>
              <td>{{ $v->created_at->format('d/m/Y') }}</td>
              <td>
                <a href="{{ route('admin.voluntarios.show', $v->id) }}" class="btn-secondary">
                  Ver
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Paginação --}}
      <div class="mt-4">
        {{ $items->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
