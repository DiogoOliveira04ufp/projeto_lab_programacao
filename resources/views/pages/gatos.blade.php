@extends('layouts.app')
@section('title', 'Gatos disponíveis')
@section('content')
  <h1>Gatos disponíveis</h1>

  @if($gatos->isEmpty())
    <p>Nenhum gato disponível no momento.</p>
  @else
    <div class="gatos-list">
      @foreach($gatos as $gato)
        <article class="gato-card">
          @if($gato->foto)
            <img src="{{ asset('public/img/' . $gato->foto) }}" alt="{{ $gato->name }}" style="max-width:200px;height:auto;">
          @endif

          <h2>{{ $gato->name }}</h2>
          <p><strong>Raça:</strong> {{ $gato->raca ?? 'Desconhecida' }}</p>
          <p><strong>Idade:</strong>
            {{ $gato->data_nascimento ? \Carbon\Carbon::parse($gato->data_nascimento)->age . ' anos' : 'Desconhecida' }}
          </p>
          <p>{{ \Illuminate\Support\Str::limit($gato->historico, 150) }}</p>
        </article>
      @endforeach
    </div>
  @endif
@endsection