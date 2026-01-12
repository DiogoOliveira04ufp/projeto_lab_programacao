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

      {{-- Se for Voluntário (Role 2), aparece a opção de remover o cargo --}}
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

  {{-- Zona de Perigo - Delete Conta --}}
  <section class="card mt-16" style="border: 1px solid #f5c6cb;">
    <h2 class="section-title" style="color: #942631;">⚠️ Zona de Perigo</h2>
    <p class="section-text">Ao eliminares a tua conta, todos os teus dados serão apagados permanentemente.</p>

    <form action="{{ route('perfil.destroy') }}" method="POST"
          onsubmit="return confirm('Tem a certeza que deseja eliminar a sua conta? Esta ação não pode ser desfeita.');"
          class="mt-16">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn" style="background-color: #ff4d4d; color: white; border: none;">
        🗑️ Eliminar a Minha Conta
      </button>
    </form>
  </section>

@endsection
