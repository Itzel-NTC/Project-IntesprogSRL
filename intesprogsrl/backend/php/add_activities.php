<?php
require_once('../../backend/config/Conexion.php');

if (isset($_POST['add_activities'])) {
    $nombre_actividad = $_POST['nombre'];

    if (empty($nombre_actividad)) {
        $errMSG = "Por favor, complete todos los campos obligatorios.";
    } else {
        $stmt = $connect->prepare("INSERT INTO actividades (nombre) VALUES(:nombre)");
        $stmt->bindParam(':nombre', $nombre_actividad);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    swal("¡Registrado!", "Nueva actividad agregada correctamente", "success").then(function() {
                        window.location.href = "../../frontend/actividades/mostrar.php";
                    });
                  </script>';
        } else {
            $errMSG = "Error al insertar la nueva actividad.";
        }
    }
}
?>
