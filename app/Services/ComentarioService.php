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
    const MAXCOMENTARIOS = 5;
    const SEGUNDOSCOMENTARIOS = 10;

    public function __construct(Comentario $comentario){
        $this->comentario = $comentario;
    }

    /**
     * Metodo responsavel por validar inserção do comentario
     */
    public function validar(Request $request){
        $retorno = false;

        $usuarioComentario = Usuario::findOrFail($request->get('usuario_id'));
        $this->validarLimiteComentarioSegundo($usuarioComentario->id);
        error_log($usuarioComentario->assinante);
        if($usuarioComentario->assinante){
            error_log("entrou primeiro if");
            $retorno = true;
        } else {
            error_log("entrou else");
            $usuarioPost = (new PostagemService(new Postagem()))->getUsuarioByPost($request->get('postagem_id'));
            if(!$usuarioComentario->assinante){
                error_log("entrou if que não é assinante");
                $comprandoDestaque = $request->get('comprando_destaque');
                if(!empty($comprandoDestaque) && $comprandoDestaque){
                    $retorno = true;
                    error_log("entrou if que pode");
                } else {
                    error_log("entrou else que não pode inserir");
                    throw new GenericException("Usuario não pode inserir comentario pois não é assinante e não está comprando destaque"); 
                }
            }
        }

        return $retorno;
    }

    /**
     * Metodo responsavel por validar limite de inserção de comentarios por segundos
     */
    public function validarLimiteComentarioSegundo($usuario_id){
        $quantidade = $this->comentario
                            ->where('usuario_id', $usuario_id)
                            ->whereBetween('created_at', [
                                                            \Carbon\Carbon::now(),
                                                            \Carbon\Carbon::now()->subSeconds(ComentarioService::SEGUNDOSCOMENTARIOS)
                                                         ]
                            )->count();
        if($quantidade > ComentarioService::MAXCOMENTARIOS){
            throw new GenericException("Não se pode fazer mais que 5 comentarios em 10 segundos"); 
        }

    }

    /**
     * Metodo responsavel por salvar o comentario
     */
    public function salvar(Request $request){
        $this->validar($request);

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
