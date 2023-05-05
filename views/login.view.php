<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500&display=swap" rel="stylesheet">
    <!-- iconos fontawesome -->
    <script src="https://kit.fontawesome.com/14c899ed1e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Iniciar Sesión</title>
</head>

<body>

    <div class="contenedor">
        <h1 class="titulo">Iniciar Sesión</h1>
        <hr class="border">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">

            <div class="form-group">
                <i class="icono izquierda fa fa-user"></i><input type="text" name="usuario" class="usuario" placeholder="User">
            </div>



            <div class="div form-group">
                <i class="icono izquierda fa fa-lock"></i><input type="password" name="password" class="password_btn" placeholder="Password">
                <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
                <!-- onclick="login.submit..(este onclick es de js y el login es 
                el nombre del formulario)" -->
            </div>

            <!-- CODIGO PHP PARA MOSTRAR EL MENSAJE DE EERO  -->
            <?php if (!empty($errores)) : ?>
                <div class="error">
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </form>

        <p class="texto-registrate">
            ¿ Aun no tienes cuenta ?
            <a href="registrate.php">Regístrate</a>
        </p>
    </div>

</body>

</html>