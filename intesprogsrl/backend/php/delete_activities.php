<?php
require_once('../../backend/config/Conexion.php');

if (isset($_POST['delete_activity'])) {
    $id_actividad = $_POST['id_actividad'];

    // Eliminar la actividad y sus subactividades
    $stmtDeleteSubactividades = $connect->prepare("DELETE FROM subactividades WHERE id_actividad = :id_actividad");
    $stmtDeleteSubactividades->bindParam(':id_actividad', $id_actividad);
    $stmtDeleteSubactividades->execute();

    $stmtDeleteActividad = $connect->prepare("DELETE FROM actividades WHERE id_actividad = :id_actividad");
    $stmtDeleteActividad->bindParam(':id_actividad', $id_actividad);

    if ($stmtDeleteActividad->execute()) {
        // Redirige a la página después de la eliminación
        header('Location: ../actividades/mostrar.php');
    } else {
        // Maneja el error si la eliminación falla
        echo "Error al eliminar la actividad.";
    }
}
?>
