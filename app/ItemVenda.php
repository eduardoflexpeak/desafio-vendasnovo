<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $guarded = [];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
