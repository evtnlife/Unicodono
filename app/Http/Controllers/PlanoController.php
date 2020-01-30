<?php

namespace App\Http\Controllers;

use App\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanoController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = Plano::all();
        return response()->json($find);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $user = Auth::user();
            $request = $request->all();
            if($user != null) {
                if ($user->type == 1) {
                    $plano = Plano::create([
                        'nome' => $request['nome'],
                        'duracao' => $request['duracao'],
                        'valor' => $request['valor']
                    ]);
                    if($plano != null){
                        return response()->json([
                            'status' => 'Plano ' . $plano->nome . ' criado com sucesso!',
                        ], 202);
                    }
                    else
                        throw new \Exception("Falha ao criar plano");
                }else{
                    return response()->json([
                        'status' => 'Você não tem permissão para criar um plano.',
                    ], 202);
                }
            }
        }catch (\Exception $ex){
            return response()->json([
                'status' => 'Falha ao criar plano.',
                'error' => $ex->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            $user = Auth::user();
            $request = $request->all();
            if($user != null)
            {
                if ($user->type == 1) {
                    $plano = Plano::find($request['id']);
                    $plano->nome = $request['nome'];
                    $plano->duracao = $request['duracao'];
                    $plano->valor = $request['valor'];
                    $plano->save();
                    if($plano != null){
                        return response()->json([
                            'status' => 'Plano ' . $plano->nome . ' editado com sucesso!',
                        ], 202);
                    }
                    else
                        throw new \Exception("Falha ao editar plano");
                }else{
                    return response()->json([
                        'status' => 'Você não tem permissão para editar um plano.',
                    ], 202);
                }
            }
        }catch (\Exception $ex){
            return response()->json([
                'status' => 'Falha ao editar plano.',
                'error' => $ex->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
