@extends('layouts.app')

@section('content')

{{-- pop-up guardar infos alteradas --}}
@if(session('success'))
  <div class="card mb-6" style="border-left:4px solid var(--success);">
    <p style="margin:0;">
      ✅ {{ session('success') }}
    </p>
  </div>
@endif

<div class="container">

  {{-- Cabeçalho --}}
  <div class="card mb-6">
    <h1>Pedido de Voluntariado #{{ $item->id }}</h1>
    <p class="text-muted">
      Submetido em {{ $item->created_at->format('d/m/Y H:i') }}
    </p>
  </div>

  {{-- Dados do voluntário --}}
  <div class="card mb-6">
    <h2>Dados do Voluntário</h2>

    <p><strong>Nome:</strong><br>{{ $item->nome }}</p>
    <p><strong>Email:</strong><br>{{ $item->email }}</p>

    <p>
      <strong>Mensagem:</strong>
    </p>
    <div class="surface p-4">
      {{ $item->mensagem }}
    </div>
  </div>

  {{-- Formulário de gestão (admin) --}}
  <div class="card">
    <h2>Gestão do Pedido</h2>

    <form method="POST" action="{{ route('admin.voluntarios.update', $item->id) }}" class="mt-4">
      @csrf

      <div class="mb-4">
        <label for="status"><strong>Status</strong></label>
        <select name="status" id="status">
          <option value="em_analise" @selected($item->status === 'em_analise')>
            Em análise
          </option>
          <option value="aprovado" @selected($item->status === 'aprovado')>
            Aprovado
          </option>
          <option value="rejeitado" @selected($item->status === 'rejeitado')>
            Rejeitado
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label for="nota_admin"><strong>Notas internas (admin)</strong></label>
        <textarea
          name="nota_admin"
          id="nota_admin"
          rows="6"
          placeholder="Observações internas sobre este pedido..."
        >{{ old('nota_admin', $item->nota_admin) }}</textarea>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-sucess">
          Guardar alterações
        </button>

        <a href="{{ route('admin.voluntarios.index') }}" class="btn-sucess">
          Voltar à lista
        </a>
      </div>
    </form>
  </div>

</div>
@endsection
