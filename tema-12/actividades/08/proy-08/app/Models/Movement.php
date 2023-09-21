<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = ['num_mov', 'account_id', 'fecha_hora', 'tipo',
    'concepto', 'cantidad', 'saldo'];

    public function account() {
        return $this->belongsTo('Account');
    }
}
