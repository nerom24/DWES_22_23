<legend>Error de Conexión</legend>
<table border=1>

    <tr>
        <th> Mensaje: </th>
        <!-- $e es un objeto de la clase PDO exception -->
        <td><?= $e->getMessage();?> </td>
    </tr>

    <tr>
        <th> Código: </th>
        <!-- $e es un objeto de la clase PDO exception -->
        <td><?= $e->getCode();?> </td>
    </tr>

    <tr>
        <th> Fichero: </th>
        <!-- $e es un objeto de la clase PDO exception -->
        <td><?= $e->getFile();?> </td>
    </tr>

    <tr>
        <th> Línea: </th>
        <!-- $e es un objeto de la clase PDO exception -->
        <td><?= $e->getLine();?> </td>
    </tr>

    <tr>
        <th> Trace: </th>
        <!-- $e es un objeto de la clase PDO exception -->
        <td><?= $e->getTraceAsString();?> </td>
    </tr>

</table>