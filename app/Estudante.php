<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'numero', 'nome', 'idade', 'sexo', 'classe', 'turno', 'morada', 'nome_encarregado', 'telefone', 'rota_id'
    ];

    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function faturas()
    {
        return $this->hasMany(Factura::class);
    }
}
