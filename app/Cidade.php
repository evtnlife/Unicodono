<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'Cidade';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nome',
        'estado_id'
    ];
    public function Estado(){
        return $this->belongsTo('App\Estado', 'estado_id', 'id');
    }
}
