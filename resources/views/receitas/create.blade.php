@extends('layouts.app')

@section('title', 'Nova Receita')

@section('content')
<style>
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        font-family: inherit;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .dynamic-list {
        margin-top: 10px;
    }

    .dynamic-item {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .dynamic-item input {
        flex: 1;
    }

    .btn-add {
        background: #28a745;
        margin-top: 10px;
    }

    .btn-add:hover {
        background: #218838;
    }

    .btn-remove {
        background: #dc3545;
        padding: 10px 15px;
    }

    .btn-remove:hover {
        background: #c82333;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .error {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }
</style>

<div class="form-container">
    <h2>Nova Receita</h2>

    <form action="{{ route('receitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            @error('titulo')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria" value="{{ old('categoria') }}" 
                   placeholder="Ex: Sobremesa, Prato Principal, Lanche...">
            @error('categoria')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>
            @error('descricao')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tempoPreparo">Tempo de Preparo (minutos)</label>
            <input type="number" id="tempoPreparo" name="tempoPreparo" value="{{ old('tempoPreparo') }}" min="1">
            @error('tempoPreparo')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="porcoes">Porções</label>
            <input type="number" id="porcoes" name="porcoes" value="{{ old('porcoes') }}" min="1">
            @error('porcoes')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Ingredientes *</label>
            <div id="ingredientes-list" class="dynamic-list">
                <div class="dynamic-item">
                    <input type="text" name="ingredientes[]" placeholder="Ex: 2 xícaras de farinha" required>
                </div>
            </div>
            <button type="button" class="btn btn-add" onclick="addIngrediente()">+ Adicionar Ingrediente</button>
        </div>

        <div class="form-group">
            <label for="modoPreparo">Modo de Preparo *</label>
            <textarea id="modoPreparo" name="modoPreparo" rows="8" required placeholder="Descreva o passo a passo do preparo...">{{ old('modoPreparo') }}</textarea>
            @error('modoPreparo')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="imagem">Imagem</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">
            @error('imagem')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('receitas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn">Salvar Receita</button>
        </div>
    </form>
</div>

<script>
    function addIngrediente() {
        const list = document.getElementById('ingredientes-list');
        const item = document.createElement('div');
        item.className = 'dynamic-item';
        item.innerHTML = `
            <input type="text" name="ingredientes[]" placeholder="Ex: 2 xícaras de farinha" required>
            <button type="button" class="btn btn-remove" onclick="this.parentElement.remove()">×</button>
        `;
        list.appendChild(item);
    }
</script>
@endsection
