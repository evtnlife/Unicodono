<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncio';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'type',
        'categoria',
        'valor',
        'km',
        'ano_fabricacao',
        'ano_modelo',
        'patrocinado',
        'unicodono',
        'titulo',
        'user_id',
        'versao_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function versao(){
        return $this->belongsTo('App\Versao');
    }
    public function imagens(){
        return $this->hasMany('App\AnuncioImagens', 'anuncio_id','id');
    }
    public function dados(){
        return $this->hasMany('App\AnuncioDados', 'anuncio_id','id');
    }
}
