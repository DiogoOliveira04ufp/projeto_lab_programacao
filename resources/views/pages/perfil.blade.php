@extends('layouts.app')

@section('title', 'O Meu Perfil')

@section('content')

  @if(session('success'))
    <div style="background: #d4edda; color: #1b7a31; padding: 15px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 20px;">
        <strong>✅ Sucesso:</strong> {{ session('success') }}
    </div>
  @endif

  <section class="hero">
    <h1 class="section-title">O Meu Perfil</h1>
    <p class="section-text muted">Gere os teus dados e cargo na plataforma.</p>
  </section>

  {{-- Forms de Atualização de Perfil --}}
  <section class="card mt-16" id="meu-perfil">
    <h2 class="section-title">👤 Informações Pessoais</h2>

    <form action="{{ route('perfil.update') }}#meu-perfil" method="POST" class="form mt-16">
      @csrf
      @method('PATCH')

      <div class="field">
        <span>Nome de Utilizador</span>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
      </div>

      <div class="field">
        <span>Email (Não alterável)</span>
        <input type="email" value="{{ $user->email }}" disabled style="background: #f4f4f4; cursor: not-allowed;">
      </div>

      @if((int)$user->role === 2)
        <div class="field" style="display: flex; align-items: center; gap: 10px; flex-direction: row;">
          <input type="checkbox" name="remover_cargo" id="remover_cargo" style="width: auto;">
          <label for="remover_cargo" style="margin: 0;">Quero deixar de ser Voluntário e passar a Utilizador Comum</label>
        </div>
      @endif

      <div class="actions">
        <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: white; border: none;">
          Atualizar Perfil
        </button>
      </div>
    </form>
  </section>

  {{-- OS MEUS PEDIDOS DE ADOÇÃO --}}
  <section class="card mt-16">
    <h2 class="section-title">🐾 Os Meus Pedidos de Adoção</h2>
    <p class="section-text muted">Estes são os gatos que pediste para adotar. O administrador irá analisar o teu pedido.</p>

    <div class="grid mt-16">
        @forelse(\App\Models\Animal::where('user_id', auth()->id())->get() as $meuGato)
            <article class="card" style="border-left: 5px solid #e879f9; display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                <div>
                    <h3 style="margin: 0;">{{ $meuGato->name }}</h3>
                    <p class="muted" style="margin: 5px 0;"><strong>Raça:</strong> {{ $meuGato->raca }}</p>

                    <div style="margin-top: 10px;">
                        @if($meuGato->status === 'pendente' || !$meuGato->status)
                            <span style="display: inline-block; background: #fff3cd; color: #856404; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; text-align: center; min-width: 140px; border: 1px solid #ffeeba;">
                                ⏳ Aguarda Aprovação
                            </span>
                        @elseif($meuGato->status === 'aprovado')
                            <span style="display: inline-block; background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; text-align: center; min-width: 140px; border: 1px solid #c3e6cb;">
                                ✅ Adoção Aprovada
                            </span>
                        @elseif($meuGato->status === 'rejeitado')
                            <span style="display: inline-block; background: #f8d7da; color: #721c24; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; text-align: center; min-width: 140px; border: 1px solid #f5c6cb;">
                                ❌ Pedido Recusado
                            </span>
                        @endif
                    </div>
                </div>

                @if($meuGato->status === 'pendente' || !$meuGato->status)
                    <form action="{{ route('perfil.cancelar_adocao', $meuGato->id) }}" method="POST"
                        onsubmit="return confirm('Tens a certeza que queres cancelar o pedido de adoção do {{ $meuGato->name }}?');"
                        style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn" style="background: #ff4d4d; color: white; border: none; padding: 10px 15px; border-radius: 4px; font-size: 0.8rem; cursor: pointer; white-space: nowrap;">
                             Cancelar Pedido
                        </button>
                    </form>
                @endif
            </article>
        @empty
            <p class="muted">Ainda não realizaste nenhum pedido de adoção.</p>
        @endforelse
    </div>
  </section>

  {{-- Delete Conta --}}
  <section class="card mt-16" style="border: 1px solid #f5c6cb;">
    <h2 class="section-title" style="color: #942631;">⚠️ Eliminar Conta</h2>
    <p class="section-text">Ao eliminares a tua conta, todos os teus dados serão apagados permanentemente.</p>

    <form action="{{ route('perfil.destroy') }}" method="POST"
          onsubmit="return confirm('Tem a certeza que deseja eliminar a sua conta? Esta ação não pode ser desfeita.');"
          class="mt-16">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn" style="background-color: #ff4d4d; color: white; border: none;">
         Eliminar a Minha Conta
      </button>
    </form>
  </section>

@endsection
