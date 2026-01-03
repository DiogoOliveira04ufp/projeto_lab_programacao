@extends('layouts.app')

@section('title', 'Avaliações')

@section('content')

  {{-- feedback --}}
  @if(session('success'))
    <div class="notice success">{{ session('success') }}</div>
  @endif

  {{-- resumo --}}
  <section class="hero">
    <h1 class="section-title">Avaliações</h1>

    <p class="section-text">
      @if($totalAvaliacoes > 0)
        Média: <strong>{{ $mediaPontuacao }}/10</strong>
        ({{ $totalAvaliacoes }} {{ $totalAvaliacoes === 1 ? 'avaliação' : 'avaliações' }})
      @else
        Ainda não existem avaliações.
      @endif
    </p>

    @if($mediaPontuacao !== null)
      <p class="mt-16">
        @php
          $estrelas = round($mediaPontuacao / 2);
        @endphp

        @for($i = 1; $i <= 5; $i++)
          {{ $i <= $estrelas ? '★' : '☆' }}
        @endfor
      </p>
    @endif
  </section>

  {{-- formulário --}}
  @auth
    <section class="card mt-16" id="form">
      <h2 class="section-title">Deixar comentário</h2>

      <form method="POST" action="{{ route('avaliacoes.store') }}" class="form">
        @csrf

        <div class="field">
          <label for="pontuacao">Pontuação (0–10)</label>
          <input
            id="pontuacao"
            name="pontuacao"
            type="number"
            min="0"
            max="10"
            value="{{ old('pontuacao', 10) }}"
            required
            aria-invalid="@error('pontuacao') true @else false @enderror"
          >
          @error('pontuacao')
            <div class="error" id="erro-pontuacao">{{ $message }}</div>
          @enderror
        </div>

        <div class="field">
          <label for="comentario">Comentário</label>
          <textarea
            id="comentario"
            name="comentario"
            rows="4"
            minlength="3"
            maxlength="1000"
            placeholder="Escreva aqui a sua experiência"
            required
            aria-invalid="@error('comentario') true @else false @enderror"
          >{{ old('comentario') }}</textarea>
          @error('comentario')
            <div class="error" id="erro-comentario">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enviar comentário</button>
      </form>
    </section>
  @else
    <section class="card mt-16">
      <p>
        Para deixar um comentário é necessário
        <a href="{{ route('login') }}">iniciar sessão</a>.
      </p>
    </section>
  @endauth

  {{-- comentários --}}
  <section class="mt-16" id="comentarios">
    <h2 class="section-title">Comentários</h2>

    @if($avaliacoes->count())
      <div class="comments-list mt-16">
        @foreach($avaliacoes as $a)
          <article class="comment">
            <div class="comment-meta">
              <strong>{{ $a->user->name ?? 'Utilizador' }}</strong>

              <span class="muted">
                {{ $a->created_at->diffForHumans() }}
              </span>

              <span class="score">{{ $a->pontuacao }}/10</span>
            </div>

            <p class="comment-text">{{ $a->comentario }}</p>
          </article>
        @endforeach
      </div>

      <div class="mt-16">
        {{ $avaliacoes->links() }}
      </div>
    @else
      <p class="muted">Sem comentários ainda.</p>
    @endif
  </section>

@endsection
