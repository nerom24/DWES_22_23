<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Gestion de articulos - Home </title>
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
                        <?php foreach (array_keys($articulos[0]) as $key): ?>
                            <th><?= $key ?></th>
                        <?php endforeach; ?>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($articulos as $indice => $articulo): ?>
                        <tr>
                            <!-- Detalles de articulos -->
                            <td><?= $articulo['id'] ?></td>
                            <td><?= $articulo['Descripcion'] ?></td>
                            <td><?= $articulo['Modelo'] ?></td>
                            <td><?= $categorias[$articulo['Categoria']] ?></td>
                            <td><?= $articulo['Unidades'] ?></td>
                            <td><?= $articulo['Precio'].'€' ?></td>
                            <!-- Columna de acciones -->
                            <td>
                                <a href="eliminar.php?key=<?=$indice?>" ><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?key=<?=$indice?>"><i class="bi bi-pencil-fill"></i></a>
                                <a href="mostrar.php?key=<?=$indice?>"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= count($articulos) ?></td></tr>
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