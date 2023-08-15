<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'ponto_partida', 'ponto_chegada', 'horario_partida', 'valor_a_pagar'];
}
