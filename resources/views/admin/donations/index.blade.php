@extends('layouts.app')

@section('title', 'Gerir Doações')

@section('content')

  <section class="hero">
    <h1 class="section-title">Gerir Doações</h1>
    <p class="section-text muted">
      Histórico de doações registadas via Stripe.
    </p>

    <div class="actions">
      <a href="{{ route('admin') }}" class="btn btn-outline">Voltar ao Admin</a>
    </div>
  </section>

  <section class="card mt-16">
    <div class="actions" style="justify-content:space-between; align-items:center;">
      <h2 class="section-title" style="margin:0;">Doações</h2>

      <p class="section-text muted" style="margin:0;">
        {{ $donations->total() }} registos • Total doado: <strong>{{ $totalEur }}€</strong>
      </p>
    </div>

    <table style="width:100%; border-collapse:collapse; margin-top:12px;">
      <thead style="background:rgba(0,0,0,.03);">
        <tr>
          <th style="padding:10px; text-align:left;">Data</th>
          <th style="padding:10px; text-align:left;">Email</th>
          <th style="padding:10px; text-align:left;">Utilizador</th>
          <th style="padding:10px; text-align:left;">Valor</th>
          <th style="padding:10px; text-align:left;">Estado</th>
          <th style="padding:10px; text-align:left;">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($donations as $d)
          @php
            $amountEur = (int) round(($d->amount_total ?? 0) / 100);
            $paidDate = $d->paid_at
              ? $d->paid_at->format('Y-m-d H:i')
              : ($d->created_at?->format('Y-m-d H:i') ?? '-');
          @endphp

          <tr style="border-top:1px solid var(--border);">
            <td style="padding:10px;">{{ $paidDate }}</td>
            <td style="padding:10px;">{{ $d->donor_email ?? '-' }}</td>
            <td style="padding:10px;">
              {{ $d->user_id ? '#' . $d->user_id : '—' }}
            </td>
            <td style="padding:10px;">
              {{ $amountEur }}€ {{ strtoupper($d->currency ?? 'eur') }}
            </td>
            <td style="padding:10px;">{{ $d->status ?? '-' }}</td>
            <td style="padding:10px;">
              <a class="btn btn-outline" href="{{ route('admin.doacoes.show', $d) }}">
                Ver
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="padding:10px;">
              Ainda não existem doações registadas.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="mt-16">
      {{ $donations->links() }}
    </div>
  </section>

@endsection
