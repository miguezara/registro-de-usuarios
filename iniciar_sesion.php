<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'registro');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar las credenciales
$sql = "SELECT id, nombre, contraseña FROM usuarios WHERE email='$email'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    if (password_verify($contrasena, $fila['contraseña'])) {
        // Iniciar sesión y redirigir al usuario a una página de inicio
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['usuario_nombre'] = $fila['nombre'];
        header('Location: iniciar_sesion.php');
        exit();
    } else {
        echo "Contraseña incorrecta. <a href='inicio_sesion.html'>Intentar de nuevo</a>.";
    }
} else {
    echo "Usuario no encontrado. <a href='registro.html'>Registrarse</a>.";
}

// Cerrar conexión
$conexion->close();
?>
