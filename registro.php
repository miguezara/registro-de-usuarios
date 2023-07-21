<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'registro');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Hash de la contraseña

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

if ($conexion->query($sql) === true) {
    echo "Registro exitoso. Ahora puedes <a href='inicio_sesion.html'>iniciar sesión</a>.";
} else {
    echo "Error al registrar el usuario: " . $conexion->error;
}

// Cerrar conexión
$conexion->close();
?>
