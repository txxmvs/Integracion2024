<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administración - Productos</title>
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
        async function fetchProducts() {
            try {
                const response = await fetch('http://localhost:3000/api/products');
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const products = await response.json();
                const productsTable = document.getElementById('products-table');
                productsTable.innerHTML = `
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th> 
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${products.map(product => `
                            <tr>
                                <td>${product.producto_marca}</td>
                                <td>${product.producto_nombre}</td>
                                <td>$${product.producto_precio}</td>
                                <td>${product.producto_stock}</td>
                                <td>${product.producto_categoria}</td> 
                                <td>
                                    <button onclick="editProduct(${product.producto_id})">Editar</button>
                                    <button onclick="deleteProduct(${product.producto_id})">Eliminar</button>
                                </td>
                            </tr>`).join('')}
                    </tbody>
                `;
            } catch (error) {
                document.getElementById('products-table').innerHTML = 'Error al cargar los productos';
                console.error('Error fetching products:', error);
            }
        }

        async function addProduct() {
            const marca = document.getElementById('new-producto-marca').value;
            const nombre = document.getElementById('new-producto-nombre').value;
            const precio = document.getElementById('new-producto-precio').value;
            const stock = document.getElementById('new-producto-stock').value;
            const foto = document.getElementById('new-producto-foto').value;
            const categoria = document.getElementById('new-producto-categoria').value;

            const newProduct = {
                producto_marca: marca,
                producto_nombre: nombre,
                producto_precio: precio,
                producto_stock: stock,
                producto_foto: foto,
                producto_categoria: categoria 
            };

            try {
                const response = await fetch('http://localhost:3000/api/products', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(newProduct)
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchProducts();
            } catch (error) {
                console.error('Error adding product:', error);
            }
        }

        async function editProduct(id) {
            const marca = prompt('Ingrese la nueva marca del producto:');
            const nombre = prompt('Ingrese el nuevo nombre del producto:');
            const precio = prompt('Ingrese el nuevo precio del producto:');
            const stock = prompt('Ingrese el nuevo stock del producto:');
            const foto = prompt('Ingrese la nueva foto del producto:');
            const categoria = prompt('Ingrese la nueva categoría del producto:'); 

            const updatedProduct = {
                producto_marca: marca,
                producto_nombre: nombre,
                producto_precio: precio,
                producto_stock: stock,
                producto_foto: foto,
                producto_categoria: categoria 
            };

            try {
                const response = await fetch(`http://localhost:3000/api/products/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updatedProduct)
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchProducts();
            } catch (error) {
                console.error('Error updating product:', error);
            }
        }

        async function deleteProduct(id) {
            try {
                const response = await fetch(`http://localhost:3000/api/products/${id}`, {
                    method: 'DELETE'
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                fetchProducts();
            } catch (error) {
                console.error('Error deleting product:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchProducts();
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Página de Administración - Productos</h1>
            <nav>
                <li><a href="admin_trabajador.php">Trabajadores</a></li>
                <li><a href="admin_usuario.php">Usuarios</a></li>
            </nav>
        <div class="form-container">
            <input type="text" id="new-producto-marca" placeholder="Marca" />
            <input type="text" id="new-producto-nombre" placeholder="Nombre" />
            <input type="number" id="new-producto-precio" placeholder="Precio" />
            <input type="number" id="new-producto-stock" placeholder="Stock" />
            <input type="text" id="new-producto-foto" placeholder="URL de la foto" />
            <input type="text" id="new-producto-categoria" placeholder="Categoría" /> 
            <button onclick="addProduct()">Agregar Producto</button>
        </div>
        <table id="products-table"></table>
    </div>
</body>
</html>