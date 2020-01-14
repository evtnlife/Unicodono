<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenda extends Model
{
    protected $table = 'revenda';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nome',
        'telefone',
        'email',
        'descricao',
        'logo',
        'user_id'
    ];
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
