<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>

</head>

<body>

    <div class="container" style="padding-top: 2%;">

        <?php require_once "template/partials/menu.php"; ?>

        <?php
        include "views/clientes/partials/cabecera.php" ?>


        <!-- Menu principal -->
        <?php require_once "views/clientes/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>
                
                    <th>Id </th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>DNI</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->clientes as $cliente) : ?>
                    <tr>
                        <td><?= $cliente->id ?></td>
                        <td><?= $cliente->nombre ?></td>
                        <td><?= $cliente->apellidos ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->telefono ?></td>
                        <td><?= $cliente->ciudad ?></td>
                        <td><?= $cliente->dni ?></td>
                        <td>
                            <a href="<?= URL ?>clientes/delete/<?= $cliente->id ?>" title="Eliminar" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                            <a href="<?= URL ?>clientes/editar/<?= $cliente->id ?>" title="Editar"> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>clientes/mostrar/<?= $cliente->id ?>" title="Mostrar"> <i class="bi bi-eye"></i> </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->clientes->rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de clientes </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>