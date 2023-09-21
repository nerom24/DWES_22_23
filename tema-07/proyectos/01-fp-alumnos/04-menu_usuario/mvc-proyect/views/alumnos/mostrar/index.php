<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title><?= $this->title ?></title>
</head>
<body>
    # Menú Principal fijo arriba
    <?php require_once("template/partials/menu.php") ?>
    
    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- Encabezado proyecto -->
        <?php include("views/alumnos/partials/cabecera.php"); ?>

        <!-- Menú Alumnos no hace falta -->
       
        <form action="<?= URL ?>alumnos/update/<?= $this->id ?>" method="POST">
                <!-- nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $this->alumno->nombre ?>" readonly>
                    <!-- <div class="form-text">Introduzca identificador del libro</div> -->
                </div>
                <!-- apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $this->alumno->apellidos ?>" readonly>
                </div>
                <!-- poblacion -->
                <div class="mb-3">
                    <label for="poblacion" class="form-label">Población</label>
                    <input type="text" class="form-control" name="poblacion" value="<?= $this->alumno->poblacion ?>" readonly>
                    <!-- <div class="form-text">Introduzca Autor del libro</div> -->
                </div>
                <!-- email -->
                <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelpId" value="<?= $this->alumno->email ?>" readonly>
                </div>
                <!-- fecha -->
                <div class="mb-3">
                    <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control" name="fechaNac" value="<?= $this->alumno->fechaNac ?>" readonly>
                </div>
                <!-- dni -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" value="<?= $this->alumno->dni ?>" readonly>
                </div>
                <!-- Curso -->
                <div class="mb-3">
                    <label for="" class="form-label">Curso</label>
                    <select class="form-select form-select-lg" name="id_curso" readonly disabled>
                        <option selected disabled>Seleccione Curso</option>
                        <?php foreach ($this->cursos as $curso): ?>
                            <option value="<?= $curso->id ?>"
                            <?= ($this->alumno->id_curso == $curso->id)? 'selected': null ?>
                            ><?= $curso->curso ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Botones de acción -->
                <a class="btn btn-primary" href="<?= URL ?>alumnos" role="button">Volver</a>
        
      </form>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include("template/partials/footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("template/partials/javascript.php");?>
    
 
</body>
</html>