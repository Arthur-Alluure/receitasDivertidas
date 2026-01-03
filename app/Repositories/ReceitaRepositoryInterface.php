<?php

namespace App\Repositories;

use App\Models\Receita;
use Illuminate\Database\Eloquent\Collection;

interface ReceitaRepositoryInterface
{
    public function all(): Collection;
    
    public function findById(int $id): ?Receita;
    
    public function create(array $data): Receita;
    
    public function update(int $id, array $data): bool;
    
    public function delete(int $id): bool;
    
    public function findByCategoria(string $categoria): Collection;
    
    public function search(string $termo): Collection;
}
