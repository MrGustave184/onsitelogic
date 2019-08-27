<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class ParticipantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

			$participantes = User::all('nombre', 'apellido', 'email', 'status', 'id', 'categoria_id');

      return view('participantes.welcome', compact('participantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				$categorias = Categoria::all();
        return view('participantes.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			// Validation here!

			User::create([
				'nombre' 					=> $request->input('nombre'),
				'apellido' 				=> $request->input('apellido'),
				'cedula'					=> $request->input('cedula'),
				'email' 					=> $request->input('email'),
				'telefono' 				=> $request->input('telefono'),
				'direccion' 			=> $request->input('direccion'),
				'fechaNacimiento' => $request->input('fechaNacimiento'),
				'categoria_id' 		=> $request->input('categoria'),
				'status' 					=> 'inasistente' // As default in the db?
			]);

			return redirect('/participantes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			$participante = User::findOrfail($id);

      return view('participantes.show', compact('participante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$categorias = Categoria::all();
			$participante = User::findOrfail($id);

      return view('participantes.edit', compact(['participante', 'categorias']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
