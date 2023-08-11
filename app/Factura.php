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

    // Adicione outros relacionamentos ou métodos conforme necessário

    public function estaEmAtraso()
    {
        return $this->status_pagamento === 'Pendente' && $this->data_vencimento < now();
    }
}
