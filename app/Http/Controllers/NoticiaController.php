<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = DB::table('noticias')
            ->join('categorias', 'noticias.id_categoria', '=', 'categorias.id')
            ->join('preferencias', 'preferencias.id_categoria', '=', 'categorias.id')
            ->join('users', 'users.id', '=', 'preferencias.id_usuario')
            ->leftJoin('likes', function($q) {
                $q->on('users.id', '=', 'likes.id_usuario')
                   ->on('noticias.id', '=', 'likes.id_noticia');
            }) 
            ->leftJoin('likes as l', 'noticias.id', '=', 'l.id_noticia')
            ->select('noticias.id', 'noticias.titulo', 'noticias.descripcion', 'noticias.fecha', 'categorias.nombre as categoria', 'likes.id as like', DB::raw('COUNT(l.id) as numlikes'))
            ->groupBy('noticias.id', 'noticias.titulo', 'noticias.descripcion', 'noticias.fecha', 'categorias.nombre', 'likes.id')
            ->where('users.id', Auth::id())->paginate(2);

        return view('dashboard', compact('noticias'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = DB::table('noticias')
            ->join('categorias', 'noticias.id_categoria', '=', 'categorias.id')
            ->leftJoin('likes', function($q) {
                $q->on('noticias.id', '=', 'likes.id_noticia')
                   ->on('likes.id_usuario', '=', DB::raw(Auth::id()));
            }) 
            ->leftJoin('likes as l', 'noticias.id', '=', 'l.id_noticia')
            ->select('noticias.id', 'noticias.titulo', 'noticias.descripcion', 'noticias.fecha', 'categorias.nombre as categoria', 'likes.id as like', DB::raw('COUNT(l.id) as numlikes'))
            ->groupBy('noticias.id', 'noticias.titulo', 'noticias.descripcion', 'noticias.fecha', 'categorias.nombre', 'likes.id')
            ->where('noticias.id', $id)->first();

        $comentarios = DB::table('comentarios')
            ->join('users', 'users.id', '=', 'comentarios.id_usuario')
            ->select('comentarios.*', 'users.name as usuario')
            ->where('comentarios.id_noticia', $id)
            ->orderByDesc('created_at')->paginate(3);

        return view('noticia', compact('noticia', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit(Noticia $noticia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        //
    }
}
