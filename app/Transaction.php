<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'code',
        'type',
        'status',
        'payment_code',
        'payment_link',
        'payment_type',
        'user_id',
    ];
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function TransactionItens(){
        return $this->hasMany('App\TransactionItem', 'transaction_id', 'id');
    }
}
