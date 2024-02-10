<?php

$host = "localhost"; 
$user = "root"; 
$pass = "2017452071";
$db = "formhtml"; 
$conn = mysqli_connect($host, $user, $pass, $db) or die("Error al conectar con la base de datos");


$nombre = $_POST['nombre']; 
$apellido = $_POST['apellido']; 
$email = $_POST['email']; 
$imagen = $_FILES['imagen']; 


if ($imagen['name'] != "") {
    $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $nombre_imagen = uniqid() . "." . $extension;
    $carpeta = "imagenes/";
    move_uploaded_file($imagen['tmp_name'], $carpeta . $nombre_imagen);
} else {
    $nombre_imagen = "";
}
$sql = "INSERT INTO usuarios (nombre, apellido, email, imagen) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $nombre_imagen);
mysqli_stmt_execute($stmt);
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "<script>alert('Registro exitoso');</script>";
    header("Location: index.html");
} else {
    echo "<script>alert('Hubo un problema al registrar los datos');</script>";
    header("Location: index.html");
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
