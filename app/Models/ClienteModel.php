<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $fillable = [
        'cnpj',
        'nome',
        'razao_social',
        'endereco'
    ];
    public $timestamps = false;
}
