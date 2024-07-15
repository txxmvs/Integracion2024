<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

        <main>
            <div class="contenedor__todo">
                <h1>FERRAMAS</h1>
                <div class="contenedor__login-register">
                    <form action="php/login_admin.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" name="usuario" placeholder="Usuario"> 
                        <input type="password" name="clave" placeholder="Contraseña">
                        <button type="submit">Entrar</button>
                    </form>

                    <form action="php/guardar_admin.php" method="POST" class="formulario__register">
                        <h2>Regístrarse</h2>
                        <input type="text" name="nombre" placeholder="Nombre">
                        <input type="text" name="rut" placeholder="RUT">
                        <input type="text" name="rol" placeholder="Rol">
                        <input type="text" name="usuario" placeholder="Usuario">
                        <input type="password" name="clave" placeholder="Contraseña">
                        <button type="submit">Registrarse</button>
                    </form>
                </div>
                <div>
                </div>
            </div>
        </main>

</body>
</html>