@extends('layouts.layout')

@section('titulo', 'Home Clientes')

@section('contenido')
    @include('partials.alerts')
    {{-- menú de clientes --}}
    @include('clients.partials.menu')
    {{-- Fin del menu --}}

    {{-- Lista de artículos --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellidos</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($clientes as $cliente) 
            <tr>
                <td scope="row">{{ $cliente['id']  }}</td>
                <td>{{ $cliente->apellidos  }}</td>
                <td>{{ $cliente->nombre  }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->ciudad  }}</td>
                <td>{{ $cliente->email  }}</td>
                <td>
                    {{-- <a href={{route('clientes.edit', $cliente->id)}} title="Editar"><i class="bi bi-pencil-square"></i></a>
                    <a href={{route('clientes.show', $cliente->id)}} title="Mostrar" ><i class="bi-eye"></i></a>
                    <a href={{route('clientes.destroy', $cliente->id)}} title="Eliminar" onclick="return confirm('Confimar elimación del corredor')"><i class="bi-trash"></i></a> --}}

                    
                    <a href="clientes/edit/{{$cliente->id}}" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                    <a href="clientes/show/{{$cliente->id}}" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
                    <a href="clientes/destroy/{{$cliente->id}}" title="Eliminar"><i class="bi bi-trash-fill" onclick="return confirm('Confimar elimación del alumno')"></i></a>

                </td>
            </tr>
        @empty 
            <li>No hay clientes registrados.</li> 
        @endforelse
        </tbody>
    </table>
    {{-- Fin lista --}}
    <br><br><br>

@endsection