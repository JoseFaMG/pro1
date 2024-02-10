<?php
$host = "localhost";
$user = "root";
$pass = "2017452071";
$db = "formhtml";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Error al conectar con la base de datos");

$busqueda = $_GET['busqueda'];

$sql = "SELECT * FROM usuarios WHERE nombre LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $busqueda);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Resultados de la búsqueda:</h2>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>Nombre: " . $row['nombre'] . "</p>";
        echo "<p>Apellido: " . $row['apellido'] . "</p>";
        echo "<p>Email: " . $row['email'] . "</p>";
        if ($row['imagen'] != "") {
            echo "<img src='imagenes/" . $row['imagen'] . "' alt='Imagen del usuario'>";
        }
        echo "<hr>";
    }
} else {
    echo "<p>No se encontraron resultados para la búsqueda.</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
