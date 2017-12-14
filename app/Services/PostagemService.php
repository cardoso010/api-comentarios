<?php

namespace App\Services;

use App\Models\Postagem;

class PostagemService
{
    public function __construct(Postagem $postagem){
        $this->postagem = $postagem;
    }

    public function getUsuarioByPost($postagem_id){
        return $this->postagem->findOrFail($postagem_id)->usuario()->first();
    }

}