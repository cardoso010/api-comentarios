<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostagensController extends Controller
{
    //
    public function listaComentario($postagem_id){
        dd($postagem_id);

        // $minutes = \Carbon\Carbon::now()->addMinutes(10);
        // $products = \Cache::remember('api::products', $minutes, function () {
        //     return Product::all();
        // });
    }
}
