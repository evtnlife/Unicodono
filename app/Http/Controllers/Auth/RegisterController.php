<?php

namespace App\Http\Controllers\Auth;

use App\Endereco;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        try{
            $endereco = Endereco::create([
                'bairro' => $data['bairro'],
                'complemento' => $data['complemento'],
                'numero' => $data['numero'],
                'rua' => $data['rua'],
                'cidade_id' => $data['cidade_id']
            ]);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'plano_id' => $data['plano_id'],
                'endereco_id' => $endereco->id,
                'documento' => $data['documento'],
                'doc_tipo' => $data['doc_tipo'] = 0 ? "cpf" : "cnpj"
            ]);
            $user['status'] = "Usuario ".$user['name']." criado com sucesso!";
            return response()->json($user, 200);
        }catch (\Exception $ex){
            $data = [
                'status' => "Falha ao criar usuario ".$data['name'],
                'expetion' => $ex->getMessage()
            ];
            return response()->json($data, 404);
        }
    }
}
