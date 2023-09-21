    <?php 
        include "template/partials/head.php";
    ?>
    <div class="container">
    <legend>Error de Base de Datos</legend>
    <table class="table">
        <thead>
            <tr>
                <th>Mensaje: </th>
                <td><?= $e->getMessage();?></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Código: </th>
                <td><?= $e->getCode();?></td>
            </tr>
            <tr>
                <th>Fichero: </th>
                <td><?= $e->getFile();?></td>
            </tr>
            <tr>
                <th>Linea: </th>
                <td><?= $e->getLine();?></td>
            </tr>
            <tr>
                <th>Trace: </th>
                <td><?= $e->getTraceAsString();?></td>
            </tr>
        </tbody>
    </table>
    </div>

<?php exit; ?>