<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Preferencia;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Preferencia  $preferencia
     * @return \Illuminate\Http\Response
     */
    public function show(Preferencia $preferencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preferencia  $preferencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Preferencia $preferencia)
    {
        $categorias = Categoria::all();
        
        $preferencias_user = DB::select("SELECT c.id, c.nombre
            from categorias c
            join preferencias p on p.id_categoria = c.id 
            join users u on u.id = p.id_usuario 
            where u.id = ".Auth::id());
        return view('preferencias', compact('categorias', 'preferencias_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preferencia  $preferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //borramos lo anterior
        DB::delete("DELETE from preferencias where id_usuario = ".Auth::id());

        //insertamos las nuevas preferencias
        if($request->post('preferencia') !== null){
            foreach($request->post('preferencia') as $valor){
                DB::insert("INSERT into preferencias (id_usuario, id_categoria) values (".Auth::id().", ".$valor.")");
            }
        }

        return redirect()->route("noticias.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preferencia  $preferencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preferencia $preferencia)
    {
        //
    }
}
