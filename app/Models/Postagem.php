<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $fillable = ['titulo', 'descricao', 'usuario_id'];

    function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }
}
