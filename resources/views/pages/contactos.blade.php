@extends('layouts.app')

@section('title', 'Contactos')

@section('content')
  {{-- HERO --}}
  <section class="hero">
    <h1>Contactos</h1>
    <p>
      Fale connosco para adoções, doações, voluntariado ou qualquer dúvida.
    </p>

    <div class="actions">
      <a class="btn btn-success" href="{{ route('doacoes') }}">Fazer doação</a>
      <a class="btn btn-primary" href="{{ route('gatos') }}">Adotar</a>
      <a class="btn btn-success2" href="{{ route('voluntarios') }}">Ser voluntário</a>
    </div>
  </section>

  {{-- INFORMAÇÃO PRINCIPAL --}}
  <section class="grid mt-16">
    <article class="card">
      <h3>Email</h3>
      <p>Envia-nos mensagem por email.</p>
      <a class="btn btn-outline" href="mailto:38107@ufp.edu.pt">38107@ufp.edu.pt</a>
    </article>

    <article class="card">
      <h3>Telefone</h3>
      <p>Whatsapp</p>
      <a class="btn btn-outline" href="tel:+351912767773">+351 912 767 773</a>
    </article>

    <article class="card">
      <h3>Instagram</h3>
      <p>Atualizações, pedidos e divulgação.</p>
      <a class="btn btn-outline" href="https://instagram.com/gatilArcaDAgua" target="_blank" rel="noopener">
        @gatilArcaDAgua
      </a>
    </article>
  </section>

  {{-- MORADA + HORÁRIO --}}
  <section class="grid mt-16">
    <article class="card span-2">
      <h3>Morada</h3>
      <p>
        Praça 9 de Abril, 349 • 4249-004 Porto
      </p>
      <a
        class="btn btn-outline"
        href="https://www.google.com/maps?q=Pra%C3%A7a%209%20de%20Abril%2C%20349%2C%204249-004%20Porto"
        target="_blank"
        rel="noopener"
      >
        Abrir no Google Maps
      </a>
    </article>

    <article class="card">
      <h3>Horário</h3>
      <p>
        Segunda a Sábado das 9:00 - 20:00 
      </p>
      <p style="margin:0; color: var(--muted);">
        Hórarios especiais, contactar primeiro
      </p>
    </article>
  </section>

  {{-- MAPA --}}
  <section class="hero mt-16">
    <h2 class="section-title">Mapa</h2>

    <div class="map-embed mt-16" aria-label="Mapa do Gatil Arca d’Água">
      <iframe
        src="https://www.google.com/maps?q=Pra%C3%A7a%209%20de%20Abril%2C%20349%2C%204249-004%20Porto&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen
        title="Mapa - Praça 9 de Abril, 349, Porto"
      ></iframe>
    </div>
  </section>
@endsection
