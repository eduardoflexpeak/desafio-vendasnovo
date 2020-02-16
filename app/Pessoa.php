<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $guarded = [];

    const CLIENTE       = 0;
    const FORNECEDOR    = 1;
    const REVENDEDOR    = 2;
    const COLABORADOR   = 3;

    const GRUPOS = [
        self::CLIENTE       => 'Cliente',
        self::FORNECEDOR    => 'Fornecedor',
        self::REVENDEDOR    => 'Revendedor',
        self::COLABORADOR   => 'Colaborador',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
