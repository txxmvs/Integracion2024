<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administración - Trabajadores</title>
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
        h1 {
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
        async function fetchTrabajadores() {
            try {
                const response = await fetch('http://localhost:3000/api/trabajadores');
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const trabajadores = await response.json();
                const trabajadoresTable = document.getElementById('trabajadores-table');
                trabajadoresTable.innerHTML = `
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>RUT</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${trabajadores.map(trabajador => `
                            <tr>
                                <td>${trabajador.trabajador_nombre}</td>
                                <td>${trabajador.trabajador_rut}</td>
                                <td>${trabajador.trabajador_usuario}</td>
                                <td>
                                    <button onclick="editTrabajador(${trabajador.trabajador_id})">Editar</button>
                                    <button onclick="deleteTrabajador(${trabajador.trabajador_id})">Eliminar</button>
                                </td>
                            </tr>`).join('')}
                    </tbody>
                `;
            } catch (error) {
                document.getElementById('trabajadores-table').innerHTML = 'Error al cargar los trabajadores';
                console.error('Error fetching trabajadores:', error);
            }
        }

        async function addTrabajador() {
            const nombre = document.getElementById('new-trabajador-nombre').value;
            const rut = document.getElementById('new-trabajador-rut').value;
            const usuario = document.getElementById('new-trabajador-usuario').value;
            const clave = document.getElementById('new-trabajador-clave').value;

            const newTrabajador = {
                trabajador_nombre: nombre,
                trabajador_rut: rut,
                trabajador_usuario: usuario,
                trabajador_clave: clave
            };

            try {
                const response = await fetch('http://localhost:3000/api/trabajadores', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(newTrabajador)
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchTrabajadores();
            } catch (error) {
                console.error('Error adding trabajador:', error);
            }
        }

        async function editTrabajador(id) {
            const nombre = prompt('Ingrese el nuevo nombre del trabajador:');
            const rut = prompt('Ingrese el nuevo RUT del trabajador:');
            const usuario = prompt('Ingrese el nuevo usuario del trabajador:');
            const clave = prompt('Ingrese la nueva clave del trabajador:');

            const updatedTrabajador = {
                trabajador_nombre: nombre,
                trabajador_rut: rut,
                trabajador_usuario: usuario,
                trabajador_clave: clave
            };

            try {
                const response = await fetch(`http://localhost:3000/api/trabajadores/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updatedTrabajador)
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchTrabajadores();
            } catch (error) {
                console.error('Error updating trabajador:', error);
            }
        }

        async function deleteTrabajador(id) {
            try {
                const response = await fetch(`http://localhost:3000/api/trabajadores/${id}`, {
                    method: 'DELETE'
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchTrabajadores();
            } catch (error) {
                console.error('Error deleting trabajador:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchTrabajadores();
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Página de Administración - Trabajadores</h1>
            <nav>
                <li><a href="admin_producto.php">Productos</a></li>
                <li><a href="admin_usuario.php">Usuarios</a></li>
            </nav>
        <div class="form-container">
            <input type="text" id="new-trabajador-nombre" placeholder="Nombre" />
            <input type="text" id="new-trabajador-rut" placeholder="RUT" />
            <input type="text" id="new-trabajador-usuario" placeholder="Usuario" />
            <input type="password" id="new-trabajador-clave" placeholder="Clave" />
            <button onclick="addTrabajador()">Agregar Trabajador</button>
        </div>
        <table id="trabajadores-table"></table>
    </div>
</body>

</html>