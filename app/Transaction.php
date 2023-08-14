<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Transaction extends Model
{
    protected $fillable = [
        'reference', 'amount', 'payment_method_id', 'estudante_id', 'user_id',
    ];

    public function method()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_id');
    }

    public function studant()
    {
        return $this->belongsTo('App\Estudante');
    }

    public function scopeFindByPaymentMethodId($query, $id)
    {
        return $query->where('payment_method_id', $id);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
