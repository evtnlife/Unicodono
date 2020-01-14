<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transactionitem';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'pagseguro_id',
        'descricao',
        'quantidade',
        'valor',
        'transaction_id'
    ];
    public function Transaction(){
        return $this->belongsTo('App\TransactionItem', 'transaction_id', 'id');
    }
}
