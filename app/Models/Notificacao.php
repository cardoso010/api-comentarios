<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = ['postagem_id', 'usuario_id', 'data_visualizou'];

    public $timestamps = false;

    function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    function postagem() {
        return $this->belongsTo('App\Models\Postagem');
    }
}
