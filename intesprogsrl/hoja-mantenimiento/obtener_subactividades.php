<?php
// obtener_subactividades.php

// Incluir el archivo de conexión
require_once '../backend/config/Conexion.php';

// Obtener el ID de la actividad seleccionada
$idActividad = isset($_GET['id']) ? $_GET['id'] : '';

// Consulta para obtener las subactividades de la actividad seleccionada
$sqlSubactividades = "SELECT descripcion FROM subactividades WHERE id_actividad = :id_actividad";
$stmt = $connect->prepare($sqlSubactividades);
$stmt->bindParam(':id_actividad', $idActividad, PDO::PARAM_INT);
$stmt->execute();

// Obtener los resultados como un array asociativo
$subactividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver las subactividades como JSON
echo json_encode($subactividades);
?>
