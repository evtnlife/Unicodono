<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'endereco_id', 'plano_id', 'remember_token', 'documento', 'doc_tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function endereco(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }
    public function plano(){
        return $this->hasOne('App\Plano', 'id', 'plano_id');
    }
    public function geoLocalizacao(){
        return $this->hasMany('App\GeoLocalizacao','user_id', 'id');
    }
    public function revenda(){
        return $this->hasMany('App\Revenda', 'user_id', 'id');
    }
    public function transaction(){
        return $this->hasMany('App\Transaction', 'user_id', 'id');
    }
}
