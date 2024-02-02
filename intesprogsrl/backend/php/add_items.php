<?php
require_once('../../backend/config/Conexion.php');

if (isset($_POST['add_items'])) {
    $serie = $_POST['serie'];
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $capacidad = $_POST['capacidad'];
    $tipo = $_POST['tipo'];
    $voltaje = $_POST['voltaje'];

    if (empty($serie) || empty($nombre) || empty($modelo) || empty($marca) || empty($capacidad) || empty($tipo) || empty($voltaje)) {
        $errMSG = "Por favor, complete todos los campos obligatorios.";
    } else {
        $stmt = $connect->prepare("INSERT INTO items (serie, nombre, modelo, marca, capacidad, tipo, voltaje) 
                                VALUES(:serie, :nombre, :modelo, :marca, :capacidad, :tipo, :voltaje)");

        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':capacidad', $capacidad);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':voltaje', $voltaje);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                        window.location = "../Items/mostrar.php";
                    });
                  </script>';
        } else {
            $errMSG = "Error al insertar.";
        }
    }
}
?>
