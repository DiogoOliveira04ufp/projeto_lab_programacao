@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section>
  <h1>Bem-vindo ao Gatil</h1>
  <p>
    Somos uma associação dedicada ao resgate, cuidado e adoção responsável de gatos.
  </p>
</section>

<hr>

<section>
  <h2>Quem somos</h2>
  <p>
    O nosso gatil acolhe gatos abandonados, fornece cuidados veterinários e procura
    famílias responsáveis para adoção.
  </p>
  <a href="{{ route('quem_somos') }}">Vê mais informações sobre o nosso trabalho</a>
</section>

<hr>

<section>
  <h2>Gatos disponíveis para adoção</h2>
  <p>
    Conhece alguns dos nossos gatos que estão à procura de um novo lar.
  </p>
  <a href="{{ route('gatos') }}">Ver gatos disponíveis</a>
</section>

<hr>

<section>
  <h2>Apoia o nosso trabalho</h2>
  <p>
    As doações ajudam-nos a garantir alimentação, cuidados veterinários e melhores
    condições para os nossos animais.
  </p>
  <a href="{{ route('doacoes') }}">Fazer uma doação</a>
</section>

<hr>

<section>
  <h2>Avaliações</h2>
  <p>
    Vê o feedback de pessoas que já adotaram ou apoiaram o nosso gatil.
  </p>
  <a href="{{ route('avaliacoes') }}">Ver avaliações</a>
</section>

<hr>

<section>
  <h2>Contactos</h2>
  <p>
    Encontra aqui as formas de comunicares connosco.
  </p>
  <a href="{{ route('contactos') }}">Ver contactos</a>
</section>

@endsection
