<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserConfig;

class UserConfigController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(Auth::check()) {
                $userConfigs = UserConfig::where('user_id', Auth::user()->id)->get();
                return response()->json($userConfigs->toArray(), 200);
            }
            throw new \Exception('Usuario não autenticado.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao obter lista de configurações",
                'exception' => $ex->getMessage()
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
        try{
            $request = $request->all();
            if(Auth::check()) {
                $userConfigs = UserConfig::create([
                    'type' => $request['type'],
                    'value' => $request['value'],
                    'user_id' => Auth::user()->id
                ]);
                return response()->json($userConfigs->toArray(), 200);
            }
            throw new Exception('Usuario não autenticado.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao criar configuração",
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
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
            $request = $request->all();
            if(Auth::check()) {
                $userConfigs = UserConfig::where('user_id', Auth::user()->id)->where('id', $request['id'])->first();
                $userConfigs->value = $request['value'];
                $userConfigs->save();
                return response()->json($userConfigs->toArray(), 200);
            }
            throw new Exception('Usuario não autenticado.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao editar configurações",
                'exception' => $ex->getMessage()
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
        try{
            $request = $request->all();
            if(Auth::check()) {
                UserConfig::find($request['id'])->delete();
                return response()->json(array('status' => 'Configuração deletada com sucesso!'), 200);
            }
            throw new Exception('Usuario não autenticado.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao deletar configuração.",
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }
}
