<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['estudante_id', 'valor', 'data_emissao', 'data_vencimento', 'status_pagamento'];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }

}
