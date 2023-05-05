<?php session_start();
#lo que digo a qui es que si el usuario tiene una session iniciada 
#entonces lo mandare al index.php
#para que una vez tenga la sesion iniciada no vuel a crear otra 
#por tanto si intenta ingresar a otra afian por url lo amndara ala que esta que es el indez

if (isset($_SESSION['usuario'])) {
    header('Location:index.php');
}

#recibiendo los datos del registro
#DIGO si el metodo de envio es igual a post entonce los datos si se enviaron 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    /* echo $usuario . $password . $password2; */

    $errores = '';

    #COMBOBANDO ERRORES
    #comprobando que los campode no esten vacion a la hora de recibir los datos del formulario

    if (empty($usuario) or empty($password) or empty($password2)) {
        $errores .= '<li>Por favor rellene todos los datos correctamente</li>';
    } else { //si no hay errrores entonces comprabare que el usuario no exista
        try {
            //code...
            $conection = new PDO("mysql:host=localhost:3308;dbname=practice_login", 'root', '');
        } catch (PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }

        #consulta para guardar fatos 
        /*statemente por $conuslta  */
        $consulta = $conection->prepare('SELECT * FROM user WHERE user = :user LIMIT 1');
        $consulta->execute(array(':user' => $usuario));
        $resultado = $consulta->fetch();

        if ($resultado != false) {
            $errores .= '<li>El nombre del usuario ya existe</li>';
        }


        #hashear o encriptar la contrasena

        $password = hash('sha512', $password);
        $password2 = hash('sha512', $password2);

        #VALIDANDO SI LAS CONTRASELLAS SON IGUALES
        #Lo que digo aqui es si la contraseña 1 es diferente a la 2 entonces 
        #muestro la variable errorres mas el texto que le indico
        if ($password != $password2) {
            $errores .= '<li>Las contraseñas no coinciden</li>';
        }
    }

    #AGREGANDO USUARIO YA SIN ERRORES A LA BASE DE DATOS
    if ($errores == '') {
        $statement = $conection->prepare('INSERT INTO user (id,user,password) VALUES (null, :user,:pass) ');
        $statement->execute(array(
            ':user' => $usuario,
            ':pass' => $password
        ));

        header('Location: login.php');
    }
}
require('views/registrate.view.php');
