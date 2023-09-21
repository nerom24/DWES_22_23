<!DOCTYPE html>
<html lang="es">

<head>

    <?php require_once("template/partials/head.php");  ?>

</head>

<body>

    <?php require_once ("template/partials/menuAut.php"); ?>

    <div class="container">
        <br>
        
        <?php include ("views/clientes/partials/cabecera.php"); ?>

        <?php require_once ("template/partials/mensaje.php"); ?>

        <?php require_once("template/partials/error.php")?>

        <?php require_once ("views/clientes/partials/menu.php"); ?>
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
                            <a href="<?= URL ?>clientes/eliminar/<?=$cliente->id?>" title="Eliminar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-trash-fill"></i></a>
                            <a href="<?= URL ?>clientes/editar/<?=$cliente->id?>" title="Editar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['editar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-pencil-fill"></i></a>
                            <a href="<?= URL ?>clientes/mostrar/<?=$cliente->id?>" title="Mostar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-eye-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->clientes->rowCount() ?> </td>
                </tr>
            </tfoot>

        </table>

    </div>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>