@extends('layouts.layout')


@section('contenido')
    {{-- contenido del home --}}
    <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Add borders</h2>
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <a href="clientes" class="btn btn-outline-secondary" type="button">Clientes</button>
          <a href="cuentas" class="btn btn-outline-secondary" type="button">Cuentas</button>
    </div>


@endsection