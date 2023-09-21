<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Gestión Alumnos - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include("partials/partial.header.php"); ?>

                
        <!-- Menú principal -->
        <?php include("partials/partial.menu.php");?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>ISBN</th>
                        <th>Fecha de edicion</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Unidades</th>
                        <th>Coste(€)</th>
                        <th>PVP(#)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <!-- En el foreach incluyo un objeto de la clase pdostatement -->
                    <?php foreach ($libros as $libro): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $libro->id ?></td>
                            <td><?= $libro->titulo ?></td>
                            <td><?= $libro->isbn ?></td>
                            <td><?= $libro->fecha_edicion ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= $libro->editorial ?></td>
                            <td><?= $libro->stock ?></td>
                            <td><?= $libro->precio_coste ?></td>
                            <td><?= $libro->precio_venta ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="delete.php?id=<?=$libro->id?>" title="Eliminar" ><i class="bi bi-trash-fill" onclick="return confirm('Confimar elimación del libro')"></i></a>
                                <a href="editar.php?id=<?=$libro->id?>" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                                <a href="mostrar.php?id=<?=$libro->id?>" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= $alumnos->rowCount() ?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include("partials/partial.footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("partials/partial.javascript.php");?>
    
 
</body>
</html>