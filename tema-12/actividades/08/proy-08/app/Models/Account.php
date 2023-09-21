<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['iban', 'client_id', 'fecha_alta',
    'saldo', 'fecha_ultimo_mov', 'num_movtos'];

    // el nombre de la función en singular
    // una cuenta solo pertenece a un cliente
    public function client() {
        return $this->belongsTo('App\Models\Client');
    }

    // el nombre función en plural 
    // una cuenta tiene varios movimientos
    public function movements() {
        return $this->hasMany('App\Models\Movement');
    }
}
