<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'endereco';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade_id'
    ];
    public function Cidade(){
        return $this->belongsTo('App\Cidade', 'cidade_id', 'id')->with('Estado');
    }
}
