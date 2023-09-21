<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = [
            [
                'id' => 1,
                'nombre' => 'Cerraduras metálicas S.A.',
                'ubicacion' => 'Madrid',
                'seccion' => 'Ferretería'
            ],
            [
                'id' => 2,
                'nombre' => 'Cenipiel',
                'ubicacion' => 'Ubrique',
                'seccion' => 'Album'
            ]
            ];

            $cabecera = ['Id', 'Nombre', 'Ubicación', 'Sección'];

            return view('clientes.index', compact('clientes', 'cabecera'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
