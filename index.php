<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/style.css">
    <title>Check-it</title>
    <link rel="icon" href="../../Resources/imagenes/checkitlogo.ico">
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="index.php"><img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"></a>
        </div>

        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="#">Contacto</a>
            <a href="#">QA</a>
        </nav>

    </div>

    <div class="image"></div>
   <header class="header">
        <div>
            <img class="marca" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit" >
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Esse doloribus nihil, ipsum neque, laboriosam ipsa voluptatibus 
                odio ad cumque provident harum ducimus aspernatur ut veniam quo 
                tempore nemo mollitia fugiat.
            </p>

            <div class="btn-home">
                <a href="/Paginas/Registro/registrarse.php" class="btn">Registrarse</a>
            </div>
        </div>
        

        <div class="form">
            <h3>Iniciar Sesión</h3>
            <form id="formulario" name="formulario" action="main.php" method="post">

                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" required>

                <label for="clave">Contraseña</label>
                <input id="clave" name="clave" type="password" required>

                <input type="submit" value="Enviar">

                <div id="respuesta"></div>

                
            </form>
        </div>
   </header>

<script src="/Resources/JS/fn.js"></script>   
</body>
</html>