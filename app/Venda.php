<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $guarded = [];

    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
