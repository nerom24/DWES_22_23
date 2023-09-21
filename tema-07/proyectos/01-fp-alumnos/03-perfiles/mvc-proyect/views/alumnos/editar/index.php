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

         <!-- Comprobamos si existe algún error -->
         <?php require_once("template/partials/error.php") ?>


        <!-- Menú Alumnos no hace falta -->
       
        <form action="<?= URL ?>alumnos/update/<?= $this->id ?>" method="POST">
                
                <!-- nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid': null ?>" name="nombre" value="<?= $this->alumno->nombre ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['nombre'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['nombre'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control <?= (isset($this->errores['apellidos']))? 'is-invalid': null ?>" name="apellidos" value="<?= $this->alumno->apellidos ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['apellidos'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['apellidos'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- poblacion -->
                <div class="mb-3">
                    <label for="poblacion" class="form-label">Población</label>
                    <input type="text" class="form-control <?= (isset($this->errores['poblacion']))? 'is-invalid': null ?>" name="poblacion" value="<?= $this->alumno->poblacion ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['poblacion'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['poblacion'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- email -->
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid': null ?>" name="email" aria-describedby="emailHelpId" value="<?= $this->alumno->email ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['email'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['email'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- fecha -->
                <div class="mb-3">
                    <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control <?= (isset($this->errores['fechaNac']))? 'is-invalid': null ?>" name="fechaNac" value="<?= $this->alumno->fechaNac ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['fechaNac'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['fechaNac'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- dni -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control <?= (isset($this->errores['dni']))? 'is-invalid': null ?>" name="dni" value="<?= $this->alumno->dni ?>">
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['dni'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['dni'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- Curso -->
                <div class="mb-3">
                    <label for="" class="form-label">Curso</label>
                    <select class="form-select form-select-lg <?= (isset($this->errores['id_curso']))? 'is-invalid': null ?>" name="id_curso">
                        <option selected disabled>Seleccione Curso</option>
                        <?php foreach ($this->cursos as $curso): ?>
                            <option value="<?= $curso->id ?>"
                            <?= ($this->alumno->id_curso == $curso->id)? 'selected' : null ?>
                            ><?= $curso->curso ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['id_curso'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['id_curso'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumnos" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
        
      </form>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include("template/partials/footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("template/partials/javascript.php");?>
    
 
</body>
</html>