<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $mensaje = crearMedico($conexion, $nombre, $especialidad);
    } elseif (isset($_POST['actualizar'])) {
        $id = $_POST['id'];
        $nuevoNombre = $_POST['nuevo_nombre'];
        $nuevaEspecialidad = $_POST['nuevo_especialidad'];
        $mensaje = actualizarMedico($conexion, $id, $nuevoNombre, $nuevaEspecialidad);
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $mensaje = eliminarMedico($conexion, $id);
    }
}

$medicos = leerMedicos($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Médicos</title>
</head>

<body>
    <h1>Gestión de Médicos</h1>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

    <h2>Crear Médico</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="especialidad" placeholder="Especialidad" required>
        <button type="submit" name="crear">Crear</button>
    </form>

    <h2>Médicos Registrados</h2>
    <ul>
        <?php foreach ($medicos as $medico): ?>
        <li>
            ID: <?= $medico['id']; ?> - Nombre: <?= $medico['nombre']; ?> - Especialidad:
            <?= $medico['especialidad']; ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $medico['id']; ?>">
                <input type="text" name="nuevo_nombre" placeholder="Nuevo Nombre">
                <input type="text" name="nuevo_especialidad" placeholder="Nueva Especialidad">
                <button type="submit" name="actualizar">Actualizar</button>
                <button type="submit" name="eliminar">Eliminar</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>

<?php
cerrarConexion($conexion);
?>