<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\TransactionItem;

class TransactionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        try{
            if(Auth::check()) {
                $transaction = Transaction::create([
                    'code' => $data['code'],
                    'type' => $data['type'],
                    'status' => $data['status'],
                    'payment_code' => $data['payment_code'],
                    'payment_link' => $data['payment_link'],
                    'payment_type' => $data['payment_type'],
                    'user_id' =>Auth::user()->id
                ]);
                $transaction = $transaction->toArray();
                $itemArray = array();
                foreach ($data['transaction_itens'] as $transaction_item) {
                    $transactionItem = TransactionItem::create([
                        'pagseguro_id' => $transaction_item['pagseguro_id'],
                        'descricao' => $transaction_item['descricao'],
                        'quantidade' => $transaction_item['quantidade'],
                        'valor' => $transaction_item['valor'],
                        'transaction_id' => $transaction['id'],
                    ]);

                    array_push($itemArray, $transactionItem->toArray());
                }
                $transaction['transactionItems'] = $itemArray;
                $transaction['status'] = "Transação ".$transaction['code']." criada com sucesso";
                return response()->json($transaction, 200);
            }
            throw new Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao criar transação ".$data['code'],
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->all();
        try{
            if(Auth::check()) {
                if(empty($data)) {
                    $transactions = Transaction::where('user_id', Auth::user()->id)->get();
                    $transaction['status'] = "Lista de transações retornada com sucesso";
                    return response()->json($transactions->toArray(), 200);
                }
                else
                {
                    $transaction = Transaction::where('user_id', Auth::user()->id)->where('id', $data['id'])->first();
                    $transaction['status'] = "Transação ".$transaction->id." retornada com sucesso";
                    return response()->json($transaction->toArray(), 200);
                }
            }
            throw new Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao exibir transação",
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }
}
