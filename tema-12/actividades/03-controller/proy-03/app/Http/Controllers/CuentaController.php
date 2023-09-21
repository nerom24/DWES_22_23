<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuentaController extends Controller
{
    //home
    public function index(){

        return 'Listado de Cuentas';

    }

    public function create(){

        return 'Create';

    }

    public function show($id){

        return "Mostrar Cuenta: $id";

    }

    public function edit($id){

        return "Editar Cuenta: $id";

    }

    public function destroy($id){

        return "Eliminar Cuenta: $id";

    }
}
