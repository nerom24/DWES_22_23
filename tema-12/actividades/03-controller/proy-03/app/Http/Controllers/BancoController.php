<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index(){

        return 'Listado de Bancos';

    }
    public function create(){

        return 'Create';

    }

    public function show($id){

        return "Mostrar Banco: $id";

    }

    public function edit($id){

        return "Editar Banco: $id";

    }

    public function destroy($id){

        return "Eliminar Banco: $id";

    }
}
