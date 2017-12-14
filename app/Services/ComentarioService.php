<?php

namespace App\Services;

use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Notificacao;
use Validator;
use Illuminate\Http\Request;
use PostagemService;

class ComentarioService
{
    public function __construct(Comentario $comentario){
        $this->comentario = $comentario;
    }

    /**
     * Metodo responsavel por salvar o comentario
     */
    public function salvar(Request $request){
        $valores = $this->validar($request);
        //Comentario::create($comentario);

        $comentario = new Comentario();
        $comentario->fill($valores);
        $comentario->save();
        if($comentario){
            Notificacao::create($request->only('usuario_id', 'postagem_id'));
        }
        return $comentario;
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

    public function validar(Request $request){
        $comprandoDestaque = $request->get('comprando_destaque');
        if(!empty($comprandoDestaque) && $comprandoDestaque){
            error_log("entrou");
            error_log($comprandoDestaque);
        }

        $usuarioComentario = Usuario::findOrFail($request->get('usuario_id'));
        $usuarioPost = (new PostagemService())->getUsuarioByPost($request->get('postagem_id'));
        


        return $request->only('usuario_id', 'postagem_id', 'comentario');
    }

}
