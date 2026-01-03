<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'ingredientes',
        'modo_preparo',
        'tempo_preparo',
        'porcoes',
        'categoria',
        'imagem',
    ];

    protected $casts = [
        'ingredientes' => 'array',
        'modo_preparo' => 'array',
        'tempo_preparo' => 'integer',
        'porcoes' => 'integer',
    ];
}
