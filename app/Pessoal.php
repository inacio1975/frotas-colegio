<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoal extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'telefone', 'cargo'];
}
