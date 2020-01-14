<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nome',
        'marca_id'
    ];
    public function Marca(){
        return $this->belongsTo('App\Marca', 'marca_id', 'id');
    }
}
