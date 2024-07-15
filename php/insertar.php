<?php
$servername = "localhost"; // Cambia esto si tu servidor de MySQL no está en localhost
$username = "root"; // Cambia por tu nombre de usuario de MySQL
$password = "Tomasito129"; // Cambia por tu contraseña de MySQL
$database = "bd_ferramas"; // Cambia por el nombre de tu base de datos

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Chequea la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Los valores que quieres insertar
$categoria = "Herramientas Electricas";
$nombre = "Destornillador";
$marca = "Sin Marca";
$precio = 5.00;
$stock = 1000;
$foto = "destornillador.jpg";

// Prepara la consulta SQL
$sql = "INSERT INTO producto (producto_categoria, producto_nombre, producto_marca, producto_precio, producto_stock, producto_foto) 
        VALUES ('$categoria', '$nombre', '$marca', $precio, $stock, '$foto')";

// Ejecuta la consulta y verifica
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>
