<?php

$servername = "localhost";
$username = "root";
$password = "Tomasito129";
$database = "bd_ferramas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}


$nombre = $_POST['nombre'];
$rut = $_POST['rut'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];


$sql = "INSERT INTO trabajador (trabajador_nombre, trabajador_rut, trabajador_usuario, trabajador_clave, trabajador_rol) 
        VALUES ('$nombre', '$rut', '$usuario', '$clave', '$rol')";

if ($conn->query($sql) === TRUE) {
  echo "Trabajador registrado correctamente";
} else {
  echo "Error al registrar trabajador: " . $conn->error;
}

$conn->close();
?>