<?php
require_once('../backend/config/Conexion.php');
// Obtener el ID del cliente desde la solicitud
$selectedClientId = $_GET['id'];

try {
    // Realizar una consulta para obtener la información del cliente
    $sql = "SELECT fiscal_servicio, direccion FROM clientes WHERE idcli = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $selectedClientId);
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Devolver la información como JSON
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        throw new Exception('Cliente no encontrado');
    }
} catch (Exception $e) {
    http_response_code(500); // Código de error interno del servidor
    echo json_encode(['error' => $e->getMessage()]);
}
?>

