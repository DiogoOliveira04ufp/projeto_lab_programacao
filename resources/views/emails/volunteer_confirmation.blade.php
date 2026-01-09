{{-- resources/views/emails/volunteer_confirmation.blade.php --}}
<h2>Pedido recebido ✅</h2>

<p>Olá {{ $data['nome'] }},</p>

<p>Recebemos o teu pedido de voluntariado e está neste momento <strong>em análise</strong>.</p>

<p>Entraremos em contacto contigo assim que possível.</p>

<p>— {{ config('mail.from.name') }}</p>
