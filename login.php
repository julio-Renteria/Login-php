<?php
session_start();
#lo que digo a qui es que si el usuario tiene una session iniciada 
#entonces lo mandare al index.php
#para que una vez tenga la sesion iniciada no vuel a crear otra 
#por tanto si intenta ingresar a otra afian por url lo amndara ala que esta que es el indez

$errores = '';

if (isset($_SESSION['usuario'])) {
    header('Location:index.php');
}

#COMPURBO DE EL USUARIO HAYA ENVIA LOS DATOS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    #CONEXION A BASE DE DATOS

    try {
        $conection = new PDO("mysql:host=localhost:3308;dbname=practice_login", 'root', '');
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }

    #VERIFICAR SI HAY USUARIOS EN LA BASE DE DATOS
    #aqui mismo hacemos la comprobacion para el ingresa conusuario y contraseña a la base de datos
    $statement = $conection->prepare(
        'SELECT * FROM user WHERE user = :user AND password = :password'
    );
    $statement->execute(array(
        ':user' => $usuario,
        ':password' => $password
    ));


    #en el condicional digo si el resultado es diferente a false entonces hay datos y creara la sesion
    $resultado = $statement->fetch();
    if ($resultado != false) {
        $_SESSION['usuario'] = $usuario; //creo una sesion donde sera igual a usuario 
        header('Location: index.php');
    } else {
        $errores .= '<li>Datos Incorrectos</li>';
    }
}

require('views/login.view.php');
