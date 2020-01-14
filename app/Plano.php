<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'plano';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nome',
        'duracao',
        'valor'
    ];
    public function Users(){
        return $this->hasMany('App\User', 'plano_id',  'id');
    }
}
