<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Produto extends Model
{
    use HasFactory;

    protected $table = 'pedido_produto';
    protected $fillable = [
        'pedido_id',
        'produto_id'
    ];
    public $timestamps = false;

    // Correção na relação com o modelo Cliente
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'pedido_produto', 'pedido_id', 'produto_id');
    }
}
