<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ComentarioService;

class ComentariosController extends Controller
{
    // private $request;
    public function __construct(ComentarioService $service){
        $this->service = $service;
    }

    // metodo que vai salvar os comentarios
    public function salvar(Request $request){
        $validator = $this->service->comentarioValidator($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validador Falhou',
                'errors'  => $validator->errors()
            ], 422); 
        }

        $comentario = $this->service->salvar($request);

        return response()->json($comentario, 201);
        //\Cache::forget('api::products');
    }

}
