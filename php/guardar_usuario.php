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
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$email = $_POST['email'];


$sql = "INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) 
        VALUES ('$nombre', '$apellido', '$usuario', '$clave', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "Usuario registrado correctamente";
} else {
  echo "Error al registrar usuario: " . $conn->error;
}

$conn->close();
?>