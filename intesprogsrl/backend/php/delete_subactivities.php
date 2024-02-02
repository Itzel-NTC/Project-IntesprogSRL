<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_subactivity'])) {
    // Verificar si se ha enviado el formulario de eliminar subactividad

    require '../../backend/config/Conexion.php';

    $id_subactividad = $_POST['id_subactividad'];

    // Eliminar la subactividad
    $deleteSubactividad = $connect->prepare("DELETE FROM subactividades WHERE id_subactividad = :id_subactividad");
    $deleteSubactividad->bindParam(':id_subactividad', $id_subactividad);
    $deleteSubactividad->execute();


    header('Location: ../actividades/mostrar.php');
    exit;
}

?>
