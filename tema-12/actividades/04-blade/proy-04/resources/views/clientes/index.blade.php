<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla Clientes</title>
</head>
<body>
    <h1>Tabla de clientes</h1>
    <table>
        <thead>
            @foreach ($cabecera as $columna)
               <th>{{$columna}}</th> 
            @endforeach
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                @foreach ($cliente as $item)
                    <th>{{$item}}</th>
                @endforeach  
                </tr> 
            @empty
                No existen clientes 
            @endforelse
            <tr></tr>
        </tbody>
    </table>
    
</body>
</html>