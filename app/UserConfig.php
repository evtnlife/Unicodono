<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    protected $table = 'user_config';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'type',
        'value',
        'user_id'
    ];
    public function UserConfig(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
