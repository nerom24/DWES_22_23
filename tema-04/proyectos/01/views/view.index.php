<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Gestión Usuarios - Home </title>
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
                        <?php foreach ($usuarios->getEncabezado() as $columna): ?>
                            <th><?= $columna ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($t_usuarios as $indice => $usuario): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $usuario->getId(); ?></td>
                            <td><?= $usuario->getNombre() ?></td>
                            <td><?= $usuario->getEmail() ?></td>
                            <td><?= $usuario->getPassword() ?></td>
                            <td><?= $usuario->getNacionalidad() ?></td>
                            <td><?= implode(', ', $usuarios->listaPerfiles($usuario->getPerfiles(),$perfiles)) ?></td>
                       
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="eliminar.php?key=<?=$indice?>" Title="Eliminar"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?key=<?=$indice?>" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                                <a href="mostrar.php?key=<?=$indice?>" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="7">Nº Registros <?= count($t_usuarios)?> </td></tr>
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