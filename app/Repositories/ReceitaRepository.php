<?php

namespace App\Repositories;

use App\Models\Receita;
use Illuminate\Database\Eloquent\Collection;

class ReceitaRepository implements ReceitaRepositoryInterface
{
    public function __construct(
        protected Receita $model
    ) {}

    public function all(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id): ?Receita
    {
        return $this->model->find($id);
    }

    public function create(array $data): Receita
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $receita = $this->findById($id);
        
        if (!$receita) {
            return false;
        }
        
        return $receita->update($data);
    }

    public function delete(int $id): bool
    {
        $receita = $this->findById($id);
        
        if (!$receita) {
            return false;
        }
        
        return $receita->delete();
    }

    public function findByCategoria(string $categoria): Collection
    {
        return $this->model
            ->where('categoria', $categoria)
            ->latest()
            ->get();
    }

    public function search(string $termo): Collection
    {
        return $this->model
            ->where('titulo', 'ILIKE', "%{$termo}%")
            ->orWhere('descricao', 'ILIKE', "%{$termo}%")
            ->orWhere('categoria', 'ILIKE', "%{$termo}%")
            ->latest()
            ->get();
    }
}
