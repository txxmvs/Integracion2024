<?php

$servername = "localhost";
$username = "root";
$password = "Tomasito129";
$database = "bd_ferramas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$calle = $_POST['calle'];
$cpostal = $_POST['cpostal'];
$localidad = $_POST['localidad'];
$pais = $_POST['pais'];


$sql = "INSERT INTO datos (dato_calle, dato_cpostal, dato_localidad, dato_pais) 
        VALUES ('$calle', '$cpostal', '$localidad', '$pais')";

if ($conn->query($sql) === TRUE) {
  echo "Usuario registrado correctamente";
} else {
  echo "Error al registrar usuario: " . $conn->error;
}

$conn->close();
?>