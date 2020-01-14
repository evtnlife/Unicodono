<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnuncioImagens extends Model
{
    protected $table = 'anuncioimagens';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'path',
        'alt',
        'order',
        'anuncio_id'
    ];
    public function Anuncio(){
        return $this->belongsTo('App\Anuncio', 'anuncio_id','id');
    }
}
