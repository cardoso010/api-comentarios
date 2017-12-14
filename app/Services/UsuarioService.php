<?php

namespace App\Services;

use App\Models\Usuario;

class ComentarioService
{
    public function __construct(Usuario $usuario){
        $this->usuario = $usuario;
    }

}