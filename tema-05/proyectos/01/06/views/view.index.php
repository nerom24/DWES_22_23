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
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Poblacion</th>
                        <th>Edad</th>
                        <th>Curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <!-- En el foreach incluyo un objeto de la clase pdostatement -->
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $alumno->id ?></td>
                            <td><?= $alumno->nombre ?></td>
                            <td><?= $alumno->apellidos ?></td>
                            <td><?= $alumno->email ?></td>
                            <td><?= $alumno->poblacion ?></td>
                            <td><?= edad($alumno->fechaNac) ?></td> 
                            <td><?= $alumno->curso ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="delete.php?id=<?=$alumno->id?>" title="Eliminar" ><i class="bi bi-trash-fill" onclick="return confirm('Confimar elimación del alumno')"></i></a>
                                <a href="editar.php?id=<?=$alumno->id?>" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                                <a href="mostrar.php?id=<?=$alumno->id?>" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
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