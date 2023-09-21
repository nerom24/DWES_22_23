<!DOCTYPE html>
<html lang="es">

<head>

    <?php require_once("template/partials/head.php");  ?>

</head>

<body>

    <?php require_once ("template/partials/menuAut.php"); ?>

    <div class="container">
        <br>
        
        <?php include ("views/albumes/partials/cabecera.php"); ?>

        <?php require_once ("template/partials/mensaje.php"); ?>

        <?php require_once("template/partials/error.php")?>

        <?php require_once ("views/albumes/partials/menu.php"); ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id</th>
                    <th>Título</th>
                    <th>Lugar</th>
                    <th>Categoria</th>
                    <th>Etiquetas</th>
                    <th>Num Fotos</th>
                    <th>Num Visitas</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->albumes as $album) : ?>
                    <tr>
                        <td><?= $album->id ?></td>
                        <td><?= $album->titulo ?></td>
                        <td><?= $album->lugar ?></td>
                        <td><?= $album->categoria ?></td>
                        <td><?= $album->etiquetas ?></td>
                        <td><?= $album->num_fotos ?></td>
                        <td><?= $album->num_visitas ?></td>
                        <td>
                            <a href="<?= URL ?>albumes/eliminar/<?=$album->id?>" title="Eliminar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))? 'class="btn disabled"': null ?> onclick="return confirm('¿Quieres Borrar?')"
                            ><i class="bi bi-trash-fill"></i></a>
                            <a href="<?= URL ?>albumes/editar/<?=$album->id?>" title="Editar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['editar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-pencil-fill"></i></a>
                            <a href="<?= URL ?>albumes/mostrar/<?=$album->id?>" title="Mostrar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-eye-fill"></i></a>
                            <a href="<?= URL ?>albumes/subir/<?=$album->id?>" title="Subir"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['subir']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-file-image"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->albumes->rowCount() ?> </td>
                </tr>
            </tfoot>

        </table>

    </div>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>