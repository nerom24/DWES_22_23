@extends('layouts.layout')

@section('titulo', 'Home Cuentas')
@section('subtitulo', 'Listado de Cuentas')

@section('contenido')
    @include('partials.alerts')
    {{-- menú de cuentas --}}
    @include('accounts.partials.menu')
    {{-- Fin del menu --}}

    {{-- Lista de cuentas --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>IBAN</th>
                <th>Actividad</th>
                <th>Num Movtos</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($cuentas as $cuenta) 
            <tr>
                <td scope="row">{{ $cuenta['id']  }}</td>
                <td>{{ $cuenta->client->nombre .' '. $cuenta->client->apellidos  }}</td>
                <td>{{ $cuenta->iban  }}</td>
                <td>{{ $cuenta->fecha_ultimo_mov }}</td>
                <td>{{ $cuenta->num_mvtos  }}</td>
                <td>{{ $cuenta->saldo  }}</td>
                <td>
                    {{-- <a href={{route('cuentas.edit', $cuenta->id)}} title="Editar"><i class="bi bi-pencil-square"></i></a>
                    <a href={{route('cuentas.show', $cuenta->id)}} title="Mostrar" ><i class="bi-eye"></i></a>
                    <a href={{route('cuentas.destroy', $cuenta->id)}} title="Eliminar" onclick="return confirm('Confimar elimación del corredor')"><i class="bi-trash"></i></a> --}}

                    
                    <a href="cuentas/edit/{{$cuenta->id}}" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                    <a href="cuentas/show/{{$cuenta->id}}" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
                    <a href="cuentas/destroy/{{$cuenta->id}}" title="Eliminar"><i class="bi bi-trash-fill" onclick="return confirm('Confimar elimación del alumno')"></i></a>

                </td>
            </tr>
        @empty 
            <li>No hay cuentas registrados.</li> 
        @endforelse
        </tbody>
    </table>
    {{-- Fin lista --}}
    <br><br><br>

@endsection