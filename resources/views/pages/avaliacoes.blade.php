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
      <p class="mt-16" style="font-size: 1.5rem; color: #f1c40f;">
        @php
          $estrelasPintadas = round($mediaPontuacao);
        @endphp
        @for($i = 1; $i <= 10; $i++)
          {{ $i <= $estrelasPintadas ? '★' : '☆' }}
        @endfor
      </p>
    @endif
  </section>

  {{-- formulário --}}
  @auth
    <section class="card mt-16" id="form">
      <h2 class="section-title">
        {{ isset($minhaAvaliacao) ? '📝 Editar ou  Apagar a minha avaliação' : '✍️ Deixar comentário' }}
      </h2>

      @if(isset($minhaAvaliacao))
        <p style="background: #e3f2fd; color: #0d47a1; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #2196f3;">
            <strong>Informação:</strong> Já submeteu uma avaliação. Pode editá-la ou removê-la abaixo.
        </p>
      @endif

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
            value="{{ old('pontuacao', $minhaAvaliacao->pontuacao ?? 10) }}"
            required

          >
          @error('pontuacao')
            <div class="error">{{ $message }}</div>
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
          >{{ old('comentario', $minhaAvaliacao->comentario ?? '') }}</textarea>
          @error('comentario')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-top: 10px;">

           <button type="submit" class="btn {{ !isset($minhaAvaliacao) ? 'btn-primary' : '' }}"
                style="{{ isset($minhaAvaliacao) ? 'background-color: #007bff; color: white;' : '' }}
                padding: 10px 15px; border-radius: 4px; border: none; cursor: pointer;">
               {{ isset($minhaAvaliacao) ? 'Atualizar Avaliação' : 'Enviar comentário' }}
            </button>
      </form>
            @if(isset($minhaAvaliacao))
                <form action="{{ route('avaliacoes.destroy', $minhaAvaliacao->id) }}" method="POST"
                      onsubmit="return confirm('Tem a certeza que deseja apagar a sua avaliação?');"
                      style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #ff4d4d; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
                         Apagar Comentário
                    </button>
                </form>
            @endif
        </div>
    </section>
  @else
    <section class="card mt-16">
      <p>Para deixar um comentário é necessário <a href="{{ route('login') }}">iniciar sessão</a>.</p>
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
                @php
                    $foiEditado = $a->updated_at->gt($a->created_at);
                @endphp
                @if($foiEditado)
                    (Edit {{ $a->updated_at->diffForHumans() }})
                @else
                    {{ $a->created_at->diffForHumans() }}
                @endif
              </span>

              <span class="score">{{ $a->pontuacao }}/10</span>
            </div>

            <p class="comment-text">{{ $a->comentario }}</p>
          </article>
        @endforeach
      </div>
      <div class="mt-16">{{ $avaliacoes->links() }}</div>
    @else
      <p class="muted">Sem comentários ainda.</p>
    @endif
  </section>

@endsection
