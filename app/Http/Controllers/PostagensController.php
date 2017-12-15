<?php

namespace App\Http\Controllers;

use App\Services\PostagemService;
use Illuminate\Http\Request;

class PostagensController extends Controller
{

    public function __construct(PostagemService $service){
        $this->service = $service;
    }

    //
    public function listaComentario($postagem_id, Request $request){
        $paged = 1;
        if ($request->input('paged')) {
            $paged = $request->input('paged');
        }
        $minutes = \Carbon\Carbon::now()->addMinutes(10);
        $comentarios = \Cache::remember('api::comentarios::postagem-'.$postagem_id.'-paged-'.$paged, $minutes, function () use ($postagem_id,$paged) {
             return $this->service->listaComentarioByPost($postagem_id, $paged);
        });

        return response()->json($comentarios, 200);
    }
}
