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
        'numero', 'nome', 'idade', 'sexo', 'classe', 'turno', 'morada', 'nome_encarregado', 'telefone'
    ];

    public function pagamentos()
    {
        return $this->hasMany('App\Payment');
    }

    public function atrasos(){
        return 0;
    }
}
