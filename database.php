<?php

$host = 'localhost';
$db = 'nombre_base_datos';
$user = 'usuario';
$pass = 'clave';

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

function crearMedico($conexion, $nombre, $especialidad)
{
    $sql = "INSERT INTO medicos (nombre, especialidad) VALUES ('$nombre', '$especialidad')";

    if (mysqli_query($conexion, $sql)) {
        return "Médico creado exitosamente.";
    } else {
        return "Error al crear médico: " . mysqli_error($conexion);
    }
}

function leerMedicos($conexion)
{
    $sql = "SELECT * FROM medicos";
    $resultado = mysqli_query($conexion, $sql);
    $medicos = [];

    if (mysqli_num_rows($resultado) > 0) {
        while ($medico = mysqli_fetch_assoc($resultado)) {
            $medicos[] = $medico;
        }
    }
    return $medicos;
}

function actualizarMedico($conexion, $id, $nuevoNombre, $nuevaEspecialidad)
{
    $sql = "UPDATE medicos SET nombre='$nuevoNombre', especialidad='$nuevaEspecialidad' WHERE id=$id";

    if (mysqli_query($conexion, $sql)) {
        return "Médico actualizado exitosamente.";
    } else {
        return "Error al actualizar médico: " . mysqli_error($conexion);
    }
}

function eliminarMedico($conexion, $id)
{
    $sql = "DELETE FROM medicos WHERE id=$id";

    if (mysqli_query($conexion, $sql)) {
        return "Médico eliminado exitosamente.";
    } else {
        return "Error al eliminar médico: " . mysqli_error($conexion);
    }
}

function cerrarConexion($conexion)
{
    mysqli_close($conexion);
}