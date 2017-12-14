<?php

namespace App\Services;

use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Notificacao;
use App\Models\Postagem;
use Validator;
use Illuminate\Http\Request;
use App\Services\PostagemService;
use App\Exceptions\GenericException;

class ComentarioService
{
    public function __construct(Comentario $comentario){
        $this->comentario = $comentario;
    }

    /**
     * Metodo responsavel por validar inserção do comentario
     */
    public function validar(Request $request){
        $retorno = false;

        $usuarioComentario = Usuario::findOrFail($request->get('usuario_id'));
        if($usuarioComentario->assinante){
            $retorno = true;
        } else {
            $usuarioPost = (new PostagemService(new Postagem()))->getUsuarioByPost($request->get('postagem_id'));
            if(!$usuarioComentario->assinante){
                $comprandoDestaque = $request->get('comprando_destaque');
                $retorno = (!empty($comprandoDestaque) && $comprandoDestaque);
            }
        }

        return $retorno;
    }

    /**
     * Metodo responsavel por salvar o comentario
     */
    public function salvar(Request $request){
       if(!$this->validar($request)){
            // exception
            throw new GenericException("Usuario não pode inserir comentario pois não é assinante ou não está comprando destaque"); 
       }
        
        $valores = $request->only('usuario_id', 'postagem_id', 'comentario');
        $comentario = new Comentario();
        $comentario->fill($valores);
        $comentario->save();
        if($comentario){
            Notificacao::create($request->only('usuario_id', 'postagem_id'));
        }
        return $comentario;
    }

    /**
     * Metodo responsavel por validar request para inserção de comentarios
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
