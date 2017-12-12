<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nome', 'login', 'website', 'senha', 'assinante'];
    
    protected $hidden = ['senha'];

    public function postagens()
    {
        return $this->hasMany('App\Models\Postagem');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario');
    }

}
