<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ComentarioRequest;

class ComentariosController extends Controller
{
    // metodo que vai salvar os comentarios
    public function salvar(ComentarioRequest $request){
        dd($request);
        //\Cache::forget('api::products');
    }

}
