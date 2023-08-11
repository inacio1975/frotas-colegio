<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'reference', 'amount', 'payment_method_id', 'type', 'estudante_id', 'user_id',
    ];

    public function method()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_id');
    }

    public function estudante()
    {
        return $this->belongsTo('App\Estudante');
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
