<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>

</head>

<body>

    <?php require_once "template/partials/menuAut.php"; ?>

    <div class="container" style="padding-top: 2%;">


        <?php
        include "views/albumes/partials/cabecera.php" ?>

        <!-- Comprobamos si existe algun mensaje -->
        <?php require_once "template/partials/mensaje.php" ?>

        <!-- Menu principal -->
        <?php require_once "views/albumes/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Titulo</th>
                    <th>Lugar</th>
                    <th>Categoria</th>
                    <th>Etiquetas</th>
                    <th>Nº Fotos</th>
                    <th>Nº Visitas</th>
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

                            <div class="btn-group">
                                <a href="<?= URL ?>albumes/delete/<?= $album->id ?>" title="Eliminar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) ? 'disabled"' : null ?>" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                                <a href="<?= URL ?>albumes/editar/<?= $album->id ?>" title="Editar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) ? 'disabled"' : null ?>"> <i class="bi bi-pencil"></i> </a>
                                <a href="<?= URL ?>albumes/mostrar/<?= $album->id ?>" title="Mostrar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) ? 'disabled"' : null ?>"> <i class="bi bi-eye"></i> </a>
                                <a href="<?= URL ?>albumes/agregar/<?= $album->id ?>" title="Agregar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["agregar"])) ? 'disabled"' : null ?>"> <i class="bi bi-cloud-arrow-up"></i>
                                </a>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->albumes->rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de albumes </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>