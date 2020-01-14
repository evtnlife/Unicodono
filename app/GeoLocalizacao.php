<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoLocalizacao extends Model
{
    protected $table = 'geolocalizacao';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'latitude',
        'longitude',
        'user_id'
    ];
    public function User(){
        $this->belongsTo('App\User', 'user_id','id');
    }
}
