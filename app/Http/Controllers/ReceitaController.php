<?php

namespace App\Http\Controllers;

use App\Repositories\ReceitaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReceitaController extends Controller
{
    public function __construct(
        protected ReceitaRepositoryInterface $receitaRepository
    ) {}

    public function index(): View
    {
        $receitas = $this->receitaRepository->all();
        
        return view('receitas.index', compact('receitas'));
    }

    public function show(int $id): View
    {
        $receita = $this->receitaRepository->findById($id);
        
        if (!$receita) {
            abort(404, 'Receita não encontrada');
        }
        
        return view('receitas.show', compact('receita'));
    }

    public function create(): View
    {
        return view('receitas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ingredientes' => 'required|array',
            'ingredientes.*' => 'required|string',
            'modo_preparo' => 'required|array',
            'modo_preparo.*' => 'required|string',
            'tempo_preparo' => 'nullable|integer|min:1',
            'porcoes' => 'nullable|integer|min:1',
            'categoria' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('receitas', 'public');
        }

        $receita = $this->receitaRepository->create($validated);

        return redirect()
            ->route('receitas.show', $receita->id)
            ->with('success', 'Receita criada com sucesso!');
    }

    public function edit(int $id): View
    {
        $receita = $this->receitaRepository->findById($id);
        
        if (!$receita) {
            abort(404, 'Receita não encontrada');
        }
        
        return view('receitas.edit', compact('receita'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ingredientes' => 'required|array',
            'ingredientes.*' => 'required|string',
            'modo_preparo' => 'required|array',
            'modo_preparo.*' => 'required|string',
            'tempo_preparo' => 'nullable|integer|min:1',
            'porcoes' => 'nullable|integer|min:1',
            'categoria' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('receitas', 'public');
        }

        $updated = $this->receitaRepository->update($id, $validated);

        if (!$updated) {
            abort(404, 'Receita não encontrada');
        }

        return redirect()
            ->route('receitas.show', $id)
            ->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->receitaRepository->delete($id);

        if (!$deleted) {
            abort(404, 'Receita não encontrada');
        }

        return redirect()
            ->route('receitas.index')
            ->with('success', 'Receita deletada com sucesso!');
    }

    public function search(Request $request): View
    {
        $termo = $request->input('q', '');
        $receitas = $this->receitaRepository->search($termo);
        
        return view('receitas.index', compact('receitas', 'termo'));
    }
}
