<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['search']]);
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
                $anuncio = Anuncio::with('imagens')->with('dados')->where('user_id', Auth::user()->id)->get();
                if(!isEmpty($anuncio)){
                    return response()->json($anuncio->toArray(), 200);
                }
                return response()->json(['status'=> "Você ainda não possui um veiculo cadastrado."], 200);
            }
            throw new Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao buscar veiculos do usuario",
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }

    public function search(Request $request)
    {
        try{
            $request = $request->all();

            $builder = Anuncio::with(
                'anuncio_imagens',
                'anuncio_dados',
                'marca',
                'modelo')->select('users.name', 'users.id','anuncio.ano',
                'anuncio.ano_modelo', 'anuncio.descricao','anuncio.id', 'anuncio.km', 'anuncio.titulo','anuncio.marca',
                'anuncio.modelo',
                'anuncio.valor', 'enderecos.uf_id')->join('users', 'users.id', '=', 'anuncio.user_id')->join('endereco', 'enderecos.id','=','users.endereco');

            $builder->where('anuncio.ativo', true);

            if(isset($request['uf_id'])){
                $builder->where('enderecos.uf_id', '=', $request['uf_id']);
            }
            if(isset($request['cidade_id'])){
                if($request['cidade_id'] != "Selecione uma Cidade")
                    $builder->where('enderecos.cidade_id', '=', $request['cidade_id']);
            }
            if(isset($request['cep'])){
                //$builder->where('enderecos.cep', '=', $request['cep']);
            }
            if(isset($request['marca']))
                $builder->where('marca', $request['marca']);

            if(isset($request['modelo'])){
                $builder->where('modelo', $request['modelo']);
            }

            if(isset($request['blindagem']) || isset($request['nao_blindagem'])){
                if(isset($request['blindagem']) && !isset($request['nao_blindagem'])){
                    $builder->where('blindagem', $request['blindagem']);
                }
                if(!isset($request['blindagem']) && isset($request['nao_blindagem'])){
                    $builder->where('blindagem', $request['nao_blindagem']);
                }
            }

            if(isset($request['versao'])){
                $builder->where('versao', $request['versao']);
            }

            if(isset($request['moto']) || isset($request['carro'])){
                if(!isset($request['carro']) && isset($request['moto'])){
                    $builder->where('moto', 1);
                } elseif(isset($request['carro']) && !isset($request['moto'])){
                    $builder->where('moto', 0);
                }
            }
            if(isset($request['usado']) || isset($request['novos'])){
                if(!isset($request['novos']) && isset($request['usado'])){
                    $builder->where('usado', 1);
                } elseif(isset($request['novos']) && !isset($request['usado'])){
                    $builder->where('usado', 0);
                }
            }
            if(isset($request['ano_minimo']))
                $builder->where('ano_modelo', '>=', $request['ano_minimo']);

            if(isset($request['ano_maximo']))
                $builder->where('ano_modelo', '<=', $request['ano_maximo']);

            if(isset($request['valor_maximo'])){
                $control = false;
                $valor_maximo = explode(' ', $request['valor_maximo']);
                if(isset($valor_maximo[1])){
                    $valor_maximo = $valor_maximo[1].'00';
                    $valor_maximo = str_replace('.','', $valor_maximo);
                    $control = true;
                }

                if($control)
                    $builder->where('valor', '<=', $valor_maximo);
                else{
                    $builder->where('valor', '!=', 0);
                }
            }

            if(isset($request['valor_minimo'])){
                $control = false;
                $valor_minimo = explode(' ', $request['valor_minimo']);
                if(isset($valor_minimo[1])){
                    $valor_minimo = $valor_minimo[1].'00';
                    $valor_minimo = str_replace('.','', $valor_minimo);
                    $control = true;
                }

                if($control)
                    $builder->where('valor','>=', $valor_minimo);
                else{
                    $builder->where('valor', '!=', 0);
                }
            }
            if(isset($request['km_minimo']) && isset($request['km_maximo'])){
                $builder->where('km','>=', $request['km_minimo'])->where('km', '<=', $request['km_maximo']);
            }

            switch ($request['orderby']){
                case 'menor_valor':
                    $builder->orderBy('valor','asc');
                    break;
                case 'maior_valor':
                    $builder->orderBy('valor','desc');
                    break;
                case 'km':
                    $builder->orderBy('km','asc');
                    break;
                case 'ordem_alfabetica':
                    $builder->orderBy('titulo','asc');
                    break;
            }
            return $builder->take(200)->paginate(10);
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao buscar veiculos do usuario",
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
            if(Auth::check())
            {
                $type = "Normal";
                $categoria = "";
                //verifica existencia de uma categoria
                if(isset($request['categoria'])) {
                    switch ($request['categoria']) {
                        case 0:
                            $categoria = "Carro";
                            break;
                        case 1:
                            $categoria = "Moto";
                            break;
                        case 2:
                            $categoria = "Caminhão";
                            break;
                        case 3:
                            $categoria = "Onibus";
                            break;
                    }
                }
                //verifica existencia de um tipo caso o cadastro seja utilizado em um importação ou cadastro de revenda
                if(isset($request['type'])) {
                    switch ($request['type']) {
                        case "Revenda":
                            $type = "Revenda";
                            break;
                        case "XML":
                            $type = "XML";
                            break;
                    }
                }

                $anuncio = Anuncio::create([
                    'type' => $type,
                    'categoria' => $categoria,
                    'valor' => $request['valor'],
                    'km' => $request['km'],
                    'ano_fabricacao' => $request['ano_fabricacao'],
                    'ano_modelo' => $request['ano_modelo'],
                    'patrocinado' => 0,
                    'unicodono' => $request['unicodono'],
                    'user_id' => Auth::user()->id,
                    'versao_id' => $request['versao_id']
                ]);


                return response()->json([
                    'status' => "Você ainda não possui um veiculo cadastrado.",
                    'anuncio' => $anuncio
                ], 200);
            }
            throw new Exception('Falha na autenticação.');
        }catch (\Exception $ex){
            $fail = [
                'status' => "Falha ao buscar veiculos do usuario",
                'exception' => $ex->getMessage()
            ];
            return response()->json($fail, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
