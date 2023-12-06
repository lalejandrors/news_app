<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoritas = DB::table('noticias')
            ->join('categorias', 'noticias.id_categoria', '=', 'categorias.id')
            ->join('favoritos', 'favoritos.id_noticia', '=', 'noticias.id')
            ->join('users', 'users.id', '=', 'favoritos.id_usuario')
            ->select('noticias.*', 'categorias.nombre as categoria')
            ->where('users.id', Auth::id())->paginate(2);

        return view('favoritas', compact('favoritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //verificar que no se repita
        $existe = DB::select("SELECT count(*) as cantidad from favoritos where id_usuario = ".Auth::id()." and id_noticia = ".$id);
        if($existe[0]->cantidad == 0){
            DB::insert("INSERT into favoritos (id_usuario, id_noticia) values (".Auth::id().", ".$id.")");
            return redirect()->route("favoritas.index")->with("success", "Noticia agregada a favoritos.");
        }else{
            return redirect()->route("noticias.index")->with("warning", "Ya tenías esa noticia en favoritos.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorito  $favorito
     * @return \Illuminate\Http\Response
     */
    public function show(Favorito $favorito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorito  $favorito
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorito $favorito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorito  $favorito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorito $favorito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorito  $favorito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE from favoritos where id_usuario = ".Auth::id()." and id_noticia = ".$id);
        return redirect()->route("favoritas.index")->with("warning", "Noticia eliminada de favoritos.");
    }
}
