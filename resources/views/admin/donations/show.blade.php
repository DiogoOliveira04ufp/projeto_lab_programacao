@extends('layouts.app')

@section('title', 'Detalhe da Doação')

@section('content')
  <section class="hero">
    <h1 class="section-title">Detalhe da Doação</h1>
    <p class="section-text muted">Informação completa do registo e IDs Stripe.</p>

    <div class="actions">
      <a href="{{ route('admin.doacoes.index') }}" class="btn btn-outline">Voltar</a>
      <a href="{{ route('admin') }}" class="btn btn-outline">Admin</a>

      <a href="{{ route('doacoes.recibo', $donation) }}" class="btn btn-outline">
        Descarregar recibo (PDF)
      </a>
    </div>
  </section>

  @php
    $amountEur = (int) round(($donation->amount_total ?? 0) / 100);
  @endphp

  <section class="card mt-16">
    <h2 class="section-title" style="margin:0;">Resumo</h2>

    <p class="mt-16"><strong>ID:</strong> #{{ $donation->id }}</p>
    <p><strong>Estado:</strong> {{ $donation->status ?? '-' }}</p>
    <p><strong>Valor:</strong> {{ $amountEur }}€ {{ strtoupper($donation->currency ?? 'eur') }}</p>
    <p><strong>Data:</strong> {{ $donation->paid_at?->format('Y-m-d H:i') ?? '-' }}</p>
  </section>

  <section class="card mt-16">
    <h2 class="section-title" style="margin:0;">Doador</h2>

    <p class="mt-16"><strong>Nome:</strong> {{ $donation->donor_name ?? '-' }}</p>
    <p><strong>Email:</strong> {{ $donation->donor_email ?? '-' }}</p>
    <p><strong>User ID:</strong> {{ $donation->user_id ?? '—' }}</p>
  </section>

  <section class="card mt-16">
    <h2 class="section-title" style="margin:0;">Stripe</h2>

    <p class="mt-16"><strong>Session ID:</strong> {{ $donation->stripe_session_id }}</p>
    <p><strong>Payment Intent ID:</strong> {{ $donation->stripe_payment_intent_id ?? '-' }}</p>
  </section>
@endsection
