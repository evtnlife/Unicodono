<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versao extends Model
{
    protected $table = 'versao';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nome',
        'modelo_id',
    ];
    public function Modelo(){
        return $this->belongsTo('App\Modelo', 'modelo_id', 'id');
    }
}
