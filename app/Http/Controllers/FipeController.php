<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FipeController extends Controller
{
    //Obtem todas as marcas cadastradas na tabela fipe.
    public function GetMarcas(){
        try {

            $curl = doRequest('GET','https://parallelum.com.br/fipe/api/v1/carros/marcas', '', true);
            dd($curl);
        }
        catch (\Exception $ex){
            Log($ex);
        }
    }
}
