<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    
    <!-- Bottstrap icons 1.9 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>

    <div class="mb-3">

        <form action="contactar/validar" method="POST">

            <div class="mb-3">

                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" required>

            </div>
            <div class="mb-3">

                <label for="" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" required>

            </div>
            <div class="mb-3">

                <label for="" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto" required>

            </div>
            <div class="mb-3">

                <label for="">Mensaje</label>
                <div class="form-floating">
                    
                    <textarea class="form-control" name="mensaje" id="mensaje" required></textarea>
                    
                </div>
            </div>


            <div class="mb-3">

                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>

            </div>

        </form>
    </div>
</body>

</html>
