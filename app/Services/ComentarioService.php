<?php

namespace App\Services;

use App\Models\Comentario;
use App\Models\Usuario;
use Validator;
use Illuminate\Http\Request;

class ComentarioService
{
    public function __construct(Comentario $comentario){
        $this->comentario = $comentario;
    }

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
    public function comentarioValidator(Request $request) {
        $validator = Validator::make($request->all(), 
            [
                'comentario' => 'required|max:500',
                'usuario_id' => 'required|numeric',
                'postagem_id' => 'required|numeric'
            ],
            [
                'required' => 'O :attribute é obrigatorio.'
            ]
        );

        return $validator;
    }

}
