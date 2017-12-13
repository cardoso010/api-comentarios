<?php

namespace App\Repositories;

use App\Models\Comentario;

class ComentarioRepository
{
    /**
     * Metodo responsavel por salvar o comentario
     */
    public function salvar(Request $request){
        $comentario = validar($request);
        Comentario::create($comentario);
    }

    /**
     * Metodo responsavel por validar inserção de comentarios
     */
    public function validar(Request $request) {

    }
}
