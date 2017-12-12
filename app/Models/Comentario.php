<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['comentario', 'lido', 'usuario_id', 'postagem_id'];
    
    function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    function postagem() {
        return $this->belongsTo('App\Models\Postagem');
    }
}
