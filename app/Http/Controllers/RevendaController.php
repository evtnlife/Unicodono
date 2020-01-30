<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Revenda;
use mysql_xdevapi\Exception;

class RevendaController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index(){
        try{
            if(Auth::check()) {
                $revenda = Auth::user()->revenda()->get();
                return response()->json($revenda, 200);
            }
            throw new \Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao deletar revenda",
                'expetion' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
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
                $revenda = Revenda::create([
                    'nome' => $data['nome'],
                    'telefone' => $data['telefone'],
                    'email' => $data['email'],
                    'descricao' => $data['descricao'],
                    'logo' => $data['logo'],
                    'user_id' => Auth::user()->id
                ]);
                $revenda['status'] = "Revenda ".$data['nome']." criada com sucesso!";
                return response()->json($revenda, 200);
            }
            throw new Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao criar revenda ".$data['nome'],
                'expetion' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        try{
            if(Auth::check()) {
                $revenda = Revenda::find($data['revenda_id']);
                if($revenda == null)
                    throw new \Exception('Revenda não encontrada no banco de dados.');
                $revenda->nome = $data['nome'];
                $revenda->telefone = $data['telefone'];
                $revenda->email = $data['email'];
                $revenda->descricao = $data['descricao'];
                $revenda->logo = $data['logo'];
                $revenda->save();
                $revenda['status'] = "Revenda " . $revenda['nome'] . " foi editado com sucesso!";
                return response()->json($revenda, 200);
            }
            throw new \Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao editar revenda ".$data['nome'],
                'expetion' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        try{
            if(Auth::check()) {
                $revenda = Revenda::find($data['revenda_id']);
                if($revenda == null){
                    throw new \Exception('Revenda não encontrada no banco de dados.');
                }
                $revenda->delete();
                $revenda['status'] = "Revenda " . $revenda['nome'] . " foi deletada com sucesso!";
                return response()->json($revenda, 200);
            }
            throw new \Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao deletar revenda",
                'expetion' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }
}
