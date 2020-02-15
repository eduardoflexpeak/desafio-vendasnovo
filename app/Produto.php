<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $guarded = [];

    const UN = 0;
    const KG = 1;
    const CX = 2;

    const UNIDADES_MEDIDAS = [
        self::UN => 'Unidade',
        self::KG => 'Kilo',
        self::CX => 'Caixa'
    ];
}
