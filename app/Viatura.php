<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{
    use HasFactory;

    protected $fillable = ['modelo', 'matricula', 'capacidade'];

    public function viagens()
    {
        return $this->hasMany(Viagem::class);
    }
}
