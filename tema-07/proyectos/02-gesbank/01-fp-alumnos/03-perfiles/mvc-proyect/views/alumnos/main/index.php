<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Gestión Alumnos - Home </title>
</head>
<body>
    <?php require_once("template/partials/menuAut.php") ?>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include("views/alumnos/partials/cabecera.php"); ?>

        <!-- Comprobamos si existe algún mensaje -->
        <?php require_once("template/partials/mensaje.php") ?>

        <!-- Comprobamos si existe algún error -->
        <?php require_once("template/partials/error.php") ?>
        
        <!-- Menú Alumnos -->
        <?php include("views/alumnos/partials/menu.php");?>
       
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
                        <th>DNI</th>
                        <th>Curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <!-- En el foreach incluyo un objeto de la clase pdostatement -->
                    <?php foreach ($this->alumnos as $alumno): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $alumno->id ?></td>
                            <td><?= $alumno->nombre ?></td>
                            <td><?= $alumno->apellidos ?></td>
                            <td><?= $alumno->email ?></td>
                            <td><?= $alumno->poblacion ?></td>
                            <td><?= edad($alumno->fechaNac) ?></td>
                            <td><?= $alumno->dni ?></td>
                            <td><?= $alumno->curso ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="<?= URL ?>alumnos/eliminar/<?=$alumno->id?>" title="Eliminar" 
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))? 'class= "btn disabled"': null ?> 
                                ><i class="btn btn-disabled bi bi-trash-fill" onclick="return confirm('Confimar elimación del alumno')"></i></a>
                                <a href="<?= URL ?>alumnos/editar/<?=$alumno->id?>" title="Editar" 
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['editar']))? 'class= "btn disabled"': null ?> 
                                ><i class="bi bi-pencil-fill"></i></a>
                                <a href="<?= URL ?>alumnos/mostrar/<?=$alumno->id?>" title="Mostrar"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar']))? 'class= "btn disabled"': null ?> 
                                ><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= $this->alumnos->rowCount() ?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include("template/partials/footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("template/partials/javascript.php");?>
    
 
</body>
</html>