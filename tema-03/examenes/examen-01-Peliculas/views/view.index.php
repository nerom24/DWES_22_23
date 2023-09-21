<!doctype html>
<html lang="es">
  <head>
    <!-- Incluimos HEAD -->
    <?php include("partials/partial.head.php") ?>
    <title>Home - CRUD Tabla Películas</title>
  </head>
  
  <body>
    <div class="container">
      
      <!-- Cabecera -->
      <?php include("partials/partial.cabecera.php"); ?>
  
      <legend>
        Tabla Películas
      </legend>

      <!-- Incluimos Partials menu -->
      <?php include("partials/partial.menu.php") ?>

      <table class="table">
        <thead>
          <tr>
            <?php 
              $claves = array_keys($peliculas[0]);
              $claves[] ="Acciones";
              foreach ($claves as $clave): ?>
                <th><?= $clave ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peliculas as $indice => $pelicula): ?>
            <tr>
            <!-- Muestro los datos del libro -->
            <?php foreach ($pelicula as $key =>$campo): ?>
              <td>
                <?php if ($key=='generos'): ?> 
                  <?= implode(', ', listaGeneros($generos, $campo)) ?> 
                <?php else: ?>
                  <?= $campo ?>
                <?php endif ?>
              </td>
            <?php endforeach; ?>
            
            <!-- Muestro los botones de acción -->
            <td>
              <a href="eliminar.php?indice=<?=$indice?>" Title="Eliminar"><i class="bi bi-trash-fill"></i></a>
              <a href="editar.php?indice=<?=$indice?>" Title="Modificar"><i class="bi bi-pencil-square"></i></a>
              <a href="mostrar.php?indice=<?=$indice?>" Title="Mostrar"><i class="bi bi-eye"></i></a>
            </td>
            <!-- Fin botones de acción -->
            
           </tr>
          <?php endforeach; ?>
          <tfoot>
            <tr>
              <td colspan="7">Número Registros: <?= count($peliculas)?></td>
            </tr>
          </tfoot>
          
        </tbody>
      </table>
      
      <!-- Incluimos Partials footer -->
      <?php include("partials/partial.footer.php") ?>
      
    </div>

    <!-- Incluimos Partials javascript bootstrap -->
    <?php include("partials/partial.javascript.php") ?>

  </body>
</html>