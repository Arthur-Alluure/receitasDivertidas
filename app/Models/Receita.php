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
        'modoPreparo',
        'tempoPreparo',
        'porcoes',
        'categoria',
        'imagem',
    ];

    protected $casts = [
        'ingredientes' => 'array',
        'tempoPreparo' => 'integer',
        'porcoes' => 'integer',
    ];
}
