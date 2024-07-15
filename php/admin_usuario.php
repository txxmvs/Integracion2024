<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administración - Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            text-align: left;
        }
        .form-container {
            margin-bottom: 20px;
        }
        input, button {
            padding: 10px;
            margin: 5px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav li {
            display: inline;
            margin-right: 10px;
        }
        nav a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border-radius: 3px;
            background-color: #f0f0f0;
        }
        nav a:hover {
            background-color: #ccc;
        }
    </style>
    <script>
        async function fetchUsuarios() {
            try {
                const response = await fetch('http://localhost:3000/api/usuarios');
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const usuarios = await response.json();
                const usuariosTable = document.getElementById('usuarios-table');
                usuariosTable.innerHTML = `
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${usuarios.map(usuario => `
                            <tr>
                                <td>${usuario.usuario_nombre}</td>
                                <td>${usuario.usuario_apellido}</td>
                                <td>${usuario.usuario_usuario}</td>
                                <td>${usuario.usuario_email}</td>
                                <td>
                                    <button onclick="deleteUsuario(${usuario.usuario_id})">Eliminar</button>
                                </td>
                            </tr>`).join('')}
                    </tbody>
                `;
            } catch (error) {
                document.getElementById('usuarios-table').innerHTML = 'Error al cargar los usuarios';
                console.error('Error fetching usuarios:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchUsuarios(); 
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Página de Administración - Usuarios</h1>
            <nav>
                <li><a href="admin_trabajador.php">Trabajadores</a></li>
                <li><a href="admin_producto.php">Productos</a></li>
            </nav>
        <table id="usuarios-table"></table>
    </div>
</body>
</html>
