@extends('layouts.app')

@section('title', 'Todas as Receitas')

@section('content')
<style>
    .search-box {
        margin-bottom: 30px;
    }

    .search-box input {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 2px solid #ddd;
        border-radius: 4px;
    }

    .receitas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .receita-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .receita-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .receita-card h3 {
        color: #ff6b6b;
        margin-bottom: 10px;
    }

    .receita-card p {
        color: #666;
        margin-bottom: 15px;
    }

    .receita-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #999;
    }

    .receita-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state h2 {
        color: #999;
        margin-bottom: 20px;
    }
</style>

<div class="search-box">
    <form action="{{ route('receitas.search') }}" method="GET">
        <input 
            type="text" 
            name="q" 
            placeholder="Buscar receitas..." 
            value="{{ $termo ?? '' }}"
        >
    </form>
</div>

@if($receitas->isEmpty())
    <div class="empty-state">
        <h2>Nenhuma receita encontrada 😢</h2>
        <a href="{{ route('receitas.create') }}" class="btn">Criar primeira receita</a>
    </div>
@else
    <div class="receitas-grid">
        @foreach($receitas as $receita)
            <div class="receita-card">
                <h3>{{ $receita->titulo }}</h3>
                
                @if($receita->categoria)
                    <p><strong>Categoria:</strong> {{ $receita->categoria }}</p>
                @endif

                <div class="receita-meta">
                    @if($receita->tempo_preparo)
                        <span>⏱️ {{ $receita->tempo_preparo }} min</span>
                    @endif
                    @if($receita->porcoes)
                        <span>🍽️ {{ $receita->porcoes }} porções</span>
                    @endif
                </div>

                @if($receita->descricao)
                    <p>{{ Str::limit($receita->descricao, 100) }}</p>
                @endif

                <a href="{{ route('receitas.show', $receita->id) }}" class="btn">Ver Receita</a>
            </div>
        @endforeach
    </div>
@endif
@endsection
