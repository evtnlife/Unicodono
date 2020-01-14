<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnuncioDados extends Model
{
    protected $table = 'anunciodados';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'type',
        'value',
        'anuncio_id'
    ];
    public function Anuncio(){
        return $this->belongsTo('App\Anuncio', 'anuncio_id','id');
    }
}
