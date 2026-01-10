<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #111;
    }

    .page {
      padding: 20px;
    }

    /* HEADER */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 16px;
    }

    .brand h1 {
      font-size: 18px;
      margin: 0;
    }

    .brand p {
      margin: 2px 0;
      color: #555;
      font-size: 11px;
    }

    .receipt-box {
      text-align: right;
    }

    .receipt-box .title {
      font-size: 14px;
      font-weight: 700;
      margin: 0;
    }

    .receipt-box .meta {
      margin: 4px 0 0 0;
      font-size: 11px;
      color: #333;
    }

    /* PANELS */
    .panel {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 12px;
      margin-top: 12px;
    }

    .panel-title {
      font-weight: 700;
      margin: 0 0 8px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    .grid td {
      padding: 4px 0;
      vertical-align: top;
    }

    .label {
      width: 140px;
      color: #555;
    }

    .value {
      color: #111;
    }

    /* ITEMS */
    .items th,
    .items td {
      padding: 8px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    .items th {
      background: #f5f5f5;
      font-weight: 700;
    }

    .right {
      text-align: right;
    }

    /* TOTAL */
    .total {
      margin-top: 10px;
      display: flex;
      justify-content: flex-end;
    }

    .total-box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px 12px;
      min-width: 220px;
    }

    .total-row {
      display: flex;
      justify-content: space-between;
      margin: 2px 0;
    }

    .grand {
      font-weight: 800;
      font-size: 13px;
    }

    .status {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 11px;
      border: 1px solid #ddd;
      background: #fafafa;
    }

    /* FOOTER */
    .footer {
      margin-top: 16px;
      border-top: 1px solid #eee;
      padding-top: 10px;
      font-size: 10.5px;
      color: #555;
    }
  </style>
</head>

<body>
@php
  $amount = number_format(($donation->amount_total ?? 0) / 100, 2, ',', '.');
  $currency = strtoupper($donation->currency ?? 'EUR');
  $date = optional($donation->paid_at)->format('d/m/Y H:i') ?? '-';
  $receiptNo = str_pad((string) $donation->id, 6, '0', STR_PAD_LEFT);
@endphp

<div class="page">

  {{-- HEADER --}}
  <div class="header">
    <div class="brand">
      <h1>Gatil Arca d'Água</h1>
      <p>Praça 9 de Abril, 349 • 4249-004 Porto</p>
      <p>Tel: +351 910 000 000 • Email: gatilArcaDAgua@ufp.edu.pt</p>
    </div>

    <div class="receipt-box">
      <p class="title">RECIBO DE DOAÇÃO</p>
      <p class="meta"><strong>Nº:</strong> {{ $receiptNo }}</p>
      <p class="meta"><strong>Data:</strong> {{ $date }}</p>
    </div>
  </div>

  {{-- DADOS DO DOADOR --}}
  <div class="panel">
    <p class="panel-title">Dados do doador</p>

    <table class="grid">
      <tr>
        <td class="label">Nome</td>
        <td class="value">{{ $donation->donor_name ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label">Email</td>
        <td class="value">{{ $donation->donor_email ?? '-' }}</td>
      </tr>
    </table>
  </div>

  {{-- DETALHES DA DOAÇÃO --}}
  <div class="panel">
    <p class="panel-title">Detalhes da doação</p>

    <table class="items">
      <thead>
        <tr>
          <th>Descrição</th>
          <th class="right">Valor</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Doação ao Gatil Arca d'Água</td>
          <td class="right">{{ $amount }} {{ $currency }}</td>
        </tr>
      </tbody>
    </table>

    <div class="total">
      <div class="total-box">
        <div class="total-row">
          <span>Subtotal</span>
          <span>{{ $amount }} {{ $currency }}</span>
        </div>
        <div class="total-row">
          <span>Taxas</span>
          <span>0,00 {{ $currency }}</span>
        </div>
        <div class="total-row grand">
          <span>Total</span>
          <span>{{ $amount }} {{ $currency }}</span>
        </div>

        <div style="margin-top:8px;">
          <span>Estado:</span>
          <span class="status">{{ $donation->status ?? '-' }}</span>
        </div>
      </div>
    </div>
  </div>

  {{-- FOOTER --}}
  <div class="footer">
    <div><strong>Referência Stripe (Session):</strong> {{ $donation->stripe_session_id }}</div>

    @if($donation->stripe_payment_intent_id)
      <div><strong>Payment Intent:</strong> {{ $donation->stripe_payment_intent_id }}</div>
    @endif

    <div style="margin-top:6px;">
      Documento gerado automaticamente para fins de registo interno.
      Não constitui recibo fiscal.
    </div>
  </div>

</div>
</body>
</html>
