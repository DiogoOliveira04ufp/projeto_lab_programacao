@extends('layouts.app')

@section('title', 'Avaliações')

@section('content')

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @auth
  <form method="POST" action="{{ route('avaliacoes.store') }}" class="mb-6">
    @csrf

    <div>
      <label for="pontuacao">Pontuação (0-10)</label>
      <input id="pontuacao" name="pontuacao" type="number" min="0" max="10" value="{{ old('pontuacao', 10) }}" required>
      @error('pontuacao') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="comentario">Comentário</label>
      <textarea id="comentario" name="comentario" rows="4" required>{{ old('comentario') }}</textarea>
      @error('comentario') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Enviar comentário</button>
  </form>
  @else
    <p>Por favor <a href="{{ route('login') }}">inicie sessão</a> para deixar um comentário.</p>
  @endauth

  <section class="comments mt-6">
    <h2>Comentários</h2>
    @if($avaliacoes->count())
      @foreach($avaliacoes as $a)
        <article class="comment mb-4">
          <div class="meta">
            <strong>{{ $a->user->name ?? 'Usuário' }}</strong>
            <small>{{ $a->created_at->diffForHumans() }}</small>
            <span class="ml-2">— {{ $a->pontuacao }}/10</span>
          </div>
          <p>{{ $a->comentario }}</p>
        </article>
      @endforeach

      {{ $avaliacoes->links() }}
    @else
      <p>Sem comentários ainda.</p>
    @endif
  </section>

@endsection
