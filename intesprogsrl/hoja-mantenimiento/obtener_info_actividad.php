<?php
require_once('../backend/config/Conexion.php');

// Obtener el ID de la actividad desde la solicitud
$selectedActividadId = $_GET['id'];

try {
    // Realizar una consulta para obtener las subactividades de la actividad
    $sql = "SELECT descripcion FROM subactividades WHERE id_actividad = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $selectedActividadId);
    $stmt->execute();

    // Obtener los resultados
    $subactividades = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Devolver las subactividades como JSON
    header('Content-Type: application/json');
    echo json_encode($subactividades);
} catch (Exception $e) {
    error_log('Error en obtener_info_actividad.php: ' . $e->getMessage());
    http_response_code(500); // Código de error interno del servidor
    echo json_encode(['error' => 'Error interno del servidor']);
}
?>
