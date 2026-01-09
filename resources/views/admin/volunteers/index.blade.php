@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Cabeçalho --}}
  <section class="hero">
    <h1 class="section-title">Pedidos de Voluntariado</h1>
    <p class="section-text muted">
      Lista de pedidos submetidos pelos utilizadores
    </p>

    <div class="actions">
      <a href="{{ route('admin') }}" class="btn btn-outline">Voltar ao painel</a>
      <a href="{{ route('home') }}" class="btn btn-outline">Voltar ao site</a>
    </div>
  </section>

   {{-- Pedidos submetidos --}}
  <section class="card mt-16">
    <div class="flex" style="justify-content:space-between; align-items:center; gap:12px;">
      <div>
        <h2 class="section-title" style="margin-bottom:4px;">Pedidos Submetidos</h2>
        <p class="muted" style="margin:0;">Gestão de pedidos (ver / aprovar / rejeitar)</p>
      </div>
      <div class="muted">
        Nesta página: <strong>{{ $items->count() }}</strong>
      </div>
    </div>

    <div class="mt-8">
      @if($items->count() === 0)
        <div class="surface p-4">
          <p class="muted" style="margin:0;">Ainda não existem pedidos de voluntariado.</p>
        </div>
      @else
        <table style="width:100%; border-collapse:collapse; margin-top:12px;">
          <thead style="background:rgba(0,0,0,.03);">
            <tr>
              <th style="padding:10px; text-align:left;">#</th>
              <th style="padding:10px; text-align:left;">Nome</th>
              <th style="padding:10px; text-align:left;">Email</th>
              <th style="padding:10px; text-align:left;">Status</th>
              <th style="padding:10px; text-align:left;">Data</th>
              <th style="padding:10px; text-align:right;">Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $v)
              <tr style="border-top:1px solid var(--border);">
                <td style="padding:10px;">#{{ $v->id }}</td>
                <td style="padding:10px;">{{ $v->nome }}</td>
                <td style="padding:10px;">{{ $v->email }}</td>
                <td style="padding:10px;">
                  @if($v->status === 'em_analise')
                    <span class="badge">Em análise</span>
                  @elseif($v->status === 'aprovado')
                    <span class="badge success">Aprovado</span>
                  @else
                    <span class="badge danger">Rejeitado</span>
                  @endif
                </td>
                <td style="padding:10px;">{{ $v->created_at->format('d/m/Y') }}</td>
                <td style="padding:10px; text-align:right;">
                  <a href="{{ route('admin.voluntarios.show', $v->id) }}" class="btn btn-outline">
                    Ver
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{-- Paginação --}}
        <div class="mt-16">
          {{ $items->links() }}
        </div>
      @endif
    </div>
  </section>

  {{-- Voluntários aprovados --}}
  <section class="card mt-16">
    <div class="flex" style="justify-content:space-between; align-items:center; gap:12px;">
      <div>
        <h2 class="section-title" style="margin-bottom:4px;">Voluntários Aprovados</h2>
        <p class="muted" style="margin:0;">Utilizadores com pedido aprovado</p>
      </div>
      <div class="muted">
        Total: <strong>{{ $voluntariosAprovados->count() }}</strong>
      </div>
    </div>

    <div class="mt-8">
      @if ($voluntariosAprovados->isEmpty())
        <div class="surface p-4">
          <p class="muted" style="margin:0;">Ainda não existem voluntários aprovados.</p>
        </div>
      @else
        <table style="width:100%; border-collapse:collapse; margin-top:12px;">
          <thead style="background:rgba(0,0,0,.03);">
            <tr>
              <th style="padding:10px; text-align:left;">Nome</th>
              <th style="padding:10px; text-align:left;">Email</th>
              <th style="padding:10px; text-align:left;">Data de aprovação</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($voluntariosAprovados as $v)
              <tr style="border-top:1px solid var(--border);">
                <td style="padding:10px;">{{ $v->nome }}</td>
                <td style="padding:10px;">{{ $v->email }}</td>
                <td style="padding:10px;">
                  {{ $v->updated_at->format('d/m/Y') }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </section>
</div>  
@endsection
