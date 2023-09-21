<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Client::all()->sortBy('id');
        return view('clients.home', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validación del formulario
        $validatedData = $request->validate
        ([
            'nombre' => ['required', 'string', 'max:25'],
            'apellidos' => ['required', 'string', 'max:50'],
            'telefono' => [ 'string', 'max:20'],
            'ciudad' => [ 'string', 'max:25'],
            'dni' => ['required', 'string', 'max:9', 'unique:clients'],
            'email' => ['required', 'string', 'max:50', 'unique:clients']
            
        ]);

        $cliente = Client::create([

            'nombre' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'telefono' => $request['telefono'],
            'ciudad' => $request['ciudad'],
            'dni' => $request['dni'],
            'email' => $request['email']

        ]);

        $cliente->save();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente creado correctamente' ); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
