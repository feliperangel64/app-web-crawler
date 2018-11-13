<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    //
    protected $table = 'carros';

    public $timestamps = false;

    protected $fillable = ['marca', 'modelo', 'ano_fabricacao', 'ano_modelo', 'preco', 'cod_carro', 'url_carro'];
}
