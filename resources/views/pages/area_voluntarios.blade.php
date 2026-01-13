@extends('layouts.app')

@section('title', 'Área de Voluntários')

@section('content')

  <section class="hero">
    <h1 class="section-title">💬 Chat da Equipa</h1>
    <p class="section-text muted">Comunicação interna para voluntários e administradores.</p>
  </section>

  @if(session('success'))
    <div class="card mt-16" style="border-left: 5px solid #28a745;">
        <strong>✅</strong> {{ session('success') }}
    </div>
  @endif

  {{-- ÁREA DAS MENSAGENS PARTE VISUAL COM VERIFICAÇÃES SE  SOU EU OU NÃO --}}
  <section class="card mt-16">
    <div id="chat-box" style="height: 450px; overflow-y: auto; padding: 10px; background: #fdfdfd; border-radius: 8px;">

        @forelse($mensagens as $msg)
            @php $isMe = $msg->user_id === auth()->id(); @endphp

            <div style="display: flex; justify-content: {{ $isMe ? 'flex-end' : 'flex-start' }}; margin-bottom: 12px;">
                <article class="card" style="
                    max-width: 75%;
                    margin: 0;
                    background: {{ $isMe ? '#e879f9' : '#fff' }};
                    color: {{ $isMe ? '#fff' : '#333' }};
                    border: 1px solid #eee;
                    padding: 12px;
                ">
                    <div style="display: flex; justify-content: space-between; gap: 20px; align-items: center;">
                        <strong style="font-size: 0.8rem;">{{ $isMe ? 'Tu' : $msg->user->name }}</strong>
                        <span class="muted" style="font-size: 0.7rem; color: {{ $isMe ? '#eee' : '#999' }};">
                            {{ $msg->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    <p style="margin-top: 8px; font-size: 0.95rem; line-height: 1.4;">{{ $msg->conteudo }}</p>

                    @if($isMe || auth()->user()->isAdmin())
                        <form action="{{ route('chat.eliminar', $msg->id) }}" method="POST" class="mt-8" style="text-align: right;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: {{ $isMe ? '#ffdada' : '#ff4d4d' }}; cursor: pointer; font-size: 0.75rem;">
                                🗑️ Apagar
                            </button>
                        </form>
                    @endif
                </article>
            </div>
        @empty
            <p class="muted text-center mt-16">Ainda não existem mensagens no chat.</p>
        @endforelse
    </div>
  </section>

  {{-- FORMULÁRIO DE ENVIO --}}
  <section class="card mt-16">
    <form action="{{ route('chat.enviar') }}" method="POST" class="form">
        @csrf
        <div class="field" style="display: flex; gap: 10px; flex-direction: row; align-items: center;">
            <input type="text" name="conteudo" placeholder="Escreve uma mensagem..." required style="flex: 1;">
            <button type="submit" class="btn btn-primary" style="background: #e879f9; color: white; border: none; padding: 10px 20px;">
                Enviar
            </button>
        </div>
    </form>
  </section>

  <script>
    var objDiv = document.getElementById("chat-box");
    objDiv.scrollTop = objDiv.scrollHeight;
  </script>

@endsection
