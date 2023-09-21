@extends('layouts.layout')

@section('subtitulo', 'Añadir Nuevo Cliente')
@section('contenido')
    @include('partials.alerts') 
    <div class="card">
        <div class="card-header">
          Formulario Nuevo Artículo
        </div>
        <div class="card-body">
           <!-- Formulario  -->

            <form action={{route('articulos.store')}} method="POST">
                @csrf
            
                <!-- Descripción  -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>
                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Modelo  -->
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo') }}" required autocomplete="modelo" autofocus>
                    @error('modelo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Código  -->
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>
                    @error('codigo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Combox select -->
                <label for="inputCategoria" class="form-label">Categoría</label>
                <select class="form-select" name="categoria_id">
                <option selected disabled>Seleccione Categoría</option>
                @foreach ($categorias as $key => $categoria)
                     <option value="{{ $key }}"
                     
                     @if ($key == old('categoria_id'))
                         selected
                     @endif
                     
                     >{{$categoria}}</option>
                @endforeach
                </select>
                @error('categoria_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- Stock  -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Unidades</label>
                    <input type="number" class="form-control @error('unidades') is-invalid @enderror" name="unidades" value="{{ old('unidades') }}" required autocomplete="unidades" autofocus>
                    @error('unidades')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Precio  -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio (€)</label>
                    <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" step="0.01" value="{{ old('precio') }}" required autocomplete="precio" autofocus>
                    @error('precio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        

        {{-- Fin Formulario --}}
    
            </div>
        
        <div class="card-footer text-muted">
             <!-- Botones de acción --------------------------------------------------->
            <a class="btn btn-secondary" href="{{ route ('articulos')}}" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Añadir</button>
        </div>
        <br><br><br><br>
    </form>
    </div>



@endsection