<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    const CREATED_AT = 'data_criado';
    const UPDATED_AT = 'data_alterada';

    protected $fillable = ['comentario', 'usuario_id', 'postagem_id'];
    
    function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    function postagem() {
        return $this->belongsTo('App\Models\Postagem');
    }
}
