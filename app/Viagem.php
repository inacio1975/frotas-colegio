<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_viagem', 'rota_id', 'viatura_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [ 'data_viagem'=>'datetime'];

    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function viatura()
    {
        return $this->belongsTo(Viatura::class);
    }
}
