<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    const CREATED_AT = 'data_criado';
    const UPDATED_AT = 'data_alterada';
    
    protected $fillable = ['titulo', 'descricao', 'usuario_id'];

    function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }
}
