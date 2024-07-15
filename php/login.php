<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Tomasito129";
$database = "bd_ferramas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuario WHERE usuario_usuario='$usuario' AND usuario_clave='$clave'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['usuario'] = $usuario; 
    header("Location: ../catalogo.php");
    exit; 
} else {
    echo "Credenciales incorrectas";
}

$conn->close();
?>