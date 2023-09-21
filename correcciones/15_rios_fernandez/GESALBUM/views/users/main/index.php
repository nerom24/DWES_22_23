<!DOCTYPE html>
<html lang="es">

<head>

    <?php require_once("template/partials/head.php");  ?>

</head>

<body>

    <?php require_once ("template/partials/menuAut.php"); ?>

    <div class="container">
        <br>
        
        <?php include ("views/users/partials/cabecera.php"); ?>

        <?php require_once ("template/partials/mensaje.php"); ?>

        <?php require_once("template/partials/error.php")?>

        <?php require_once ("views/users/partials/menu.php"); ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id </th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->users as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->perfil ?></td>
                        <td>
                            <a href="<?= URL ?>users/delete/<?=$user->id?>" title="Eliminar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-trash-fill"></i></a>
                            <a href="<?= URL ?>users/editar/<?=$user->id?>" title="Editar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['editar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-pencil-fill"></i></a>
                            <a href="<?= URL ?>users/mostrar/<?=$user->id?>" title="Mostar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-eye-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->users->rowCount() ?> </td>
                </tr>
            </tfoot>

        </table>

    </div>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>