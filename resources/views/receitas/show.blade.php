@extends('layouts.app')

@section('title', $receita->titulo)

@section('content')
<style>
    .receita-header {
        background: white;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .receita-header h2 {
        color: #ff6b6b;
        margin-bottom: 15px;
    }

    .receita-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        font-size: 16px;
        color: #666;
    }

    .receita-section {
        background: white;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .receita-section h3 {
        color: #ff6b6b;
        margin-bottom: 15px;
        border-bottom: 2px solid #ff6b6b;
        padding-bottom: 10px;
    }

    .ingredientes-list, .preparo-list {
        list-style: none;
        padding: 0;
    }

    .ingredientes-list li {
        padding: 10px;
        margin-bottom: 8px;
        background: #f8f9fa;
        border-radius: 4px;
    }

    .ingredientes-list li:before {
        content: "✓ ";
        color: #ff6b6b;
        font-weight: bold;
        margin-right: 8px;
    }

    .preparo-list li {
        padding: 15px;
        margin-bottom: 10px;
        background: #f8f9fa;
        border-radius: 4px;
        border-left: 4px solid #ff6b6b;
    }

    .preparo-list li strong {
        color: #ff6b6b;
    }

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
</style>

<div class="receita-header">
    <h2>{{ $receita->titulo }}</h2>
    
    <div class="receita-meta">
        @if($receita->categoria)
            <span>📂 {{ $receita->categoria }}</span>
        @endif
        @if($receita->tempo_preparo)
            <span>⏱️ {{ $receita->tempo_preparo }} minutos</span>
        @endif
        @if($receita->porcoes)
            <span>🍽️ {{ $receita->porcoes }} porções</span>
        @endif
    </div>

    @if($receita->descricao)
        <p>{{ $receita->descricao }}</p>
    @endif
</div>

<div class="receita-section">
    <h3>🥘 Ingredientes</h3>
    <ul class="ingredientes-list">
        @foreach($receita->ingredientes as $ingrediente)
            <li>{{ $ingrediente }}</li>
        @endforeach
    </ul>
</div>

<div class="receita-section">
    <h3>👨‍🍳 Modo de Preparo</h3>
    <ol class="preparo-list">
        @foreach($receita->modo_preparo as $index => $passo)
            <li>
                <strong>Passo {{ $index + 1 }}:</strong> {{ $passo }}
            </li>
        @endforeach
    </ol>
</div>

<div class="actions">
    <a href="{{ route('receitas.index') }}" class="btn btn-secondary">Voltar</a>
    <a href="{{ route('receitas.edit', $receita->id) }}" class="btn">Editar</a>
    <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" style="display: inline;" 
          onsubmit="return confirm('Tem certeza que deseja deletar esta receita?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Deletar</button>
    </form>
</div>
@endsection
