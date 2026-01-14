@extends('layouts.app')

@section('title', 'Gestão de Adoções')

@section('content')
<section class="hero">
    <h1 class="section-title"> Gestão de Pedidos de Adoção</h1>
    <div class="actions mt-16">
        <a href="{{ route('admin') }}" class="btn btn-outline"> Painel Admin</a>
        <a href="{{ route('home') }}" class="btn btn-outline"> Início</a>
    </div>
</section>
{{-- FEEDBACK --}}
@if(session('success'))
    <div style="background: #d4edda; color: #1b7a31; padding: 15px; border-radius: 8px; margin-top: 20px;">
        {{ session('success') }}
    </div>
@endif

{{-- TABELA PEDIDOS DE ADOÇÃO AGUARDAM RESPOSTA DO ADMIN --}}
<section class="card mt-16">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:rgba(0,0,0,.03);">
                <th style="padding:12px; text-align:left;">Gato</th>
                <th style="padding:12px; text-align:left;">Utilizador</th>
                <th style="padding:12px; text-align:left;">Estado</th>
                <th style="padding:12px; text-align:left;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $p)
            <tr style="border-top:1px solid #eee;">
                <td style="padding:12px;"><strong>{{ $p->name }}</strong></td>
                <td style="padding:12px;">{{ $p->user->name }} ({{ $p->user->email }})</td>
                <td style="padding:12px;">

                    @if($p->status === 'aprovado')
                        <span style="color:green; font-weight:bold;">✅ Aprovado</span>
                    @elseif($p->status === 'rejeitado')
                        <span style="color:red; font-weight:bold;">❌ Rejeitado</span>
                    @else
                        <span style="color:orange; font-weight:bold;">⏳ Pendente</span>
                    @endif
                </td>
                <td style="padding:12px;">

                    <form action="{{ route('admin.adocoes.update', $p->id) }}" method="POST" style="display:inline-flex; gap:10px;">
                        @csrf
                        @method('PATCH')
                        <button name="status" value="aprovado" class="btn" style="background:#28a745; color:white; padding:5px 10px; border:none; cursor:pointer;">Aprovar</button>
                        <button name="status" value="rejeitado" class="btn" style="background:#dc3545; color:white; padding:5px 10px; border:none; cursor:pointer;">Recusar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
