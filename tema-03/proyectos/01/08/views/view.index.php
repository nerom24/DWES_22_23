<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Libros Proyecto </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-journal-richtext" style="font-size: 3rem; color: cornflowerblue;"></i>        
            <span class="fs-4">Proyecto CRUD Libros - Fase 7</span>
        </header>

        <legend>Tabla de Libros</legend>
        
        <!-- Menú principal -->
        <?php include("partials/partial.menu.php");?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <?php foreach (array_keys($libros[0]) as $key): ?>
                            <th><?= $key ?></th>
                        <?php endforeach; ?>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($libros as $indice => $libro): ?>
                        <tr>
                            <?php foreach ($libro as $campo): ?>
                                <td><?= $campo ?></td>
                            <?php endforeach; ?>
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
                    <tr><td colspan="6">Nº Registros <?= count($libros) ?></td></tr>
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