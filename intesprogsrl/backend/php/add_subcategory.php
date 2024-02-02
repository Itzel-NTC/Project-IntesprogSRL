<?php
require_once('../../backend/config/Conexion.php');

if (isset($_POST['add_subcategory'])) {
    // Obtener datos del formulario
    $nosubcate = trim($_POST['catnom']);
    $idcate = $_POST['idcate']; // Asegúrate de que esta variable se esté pasando correctamente desde el formulario

    // Validar si el nombre de la subcategoría está vacío
    if (empty($nosubcate)) {
        echo '<script type="text/javascript">
                swal("Error!", "Por favor, ingrese un nombre para la subcategoría.", "error").then(function() {
                    window.location = "nuevo.php";
                });
              </script>';
    } else {
        // Verificar si la subcategoría ya existe para la categoría seleccionada
        $sql = "SELECT * FROM subcategoria WHERE nosubcate = :nosubcate AND idcate = :idcate";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':nosubcate', $nosubcate);
        $stmt->bindParam(':idcate', $idcate);
        $stmt->execute();

        if ($stmt->fetchColumn() == 0) { // Si no existe, insertar la subcategoría
            $sql = "INSERT INTO subcategoria (nosubcate, idcate, state) VALUES (:nosubcate, :idcate, '1')";
            $statement = $connect->prepare($sql);
            $statement->bindParam(':nosubcate', $nosubcate);
            $statement->bindParam(':idcate', $idcate);

            if ($statement->execute()) {
                echo '<script type="text/javascript">
                        swal("¡Registrado!", "Se agregó la subcategoría correctamente.", "success").then(function() {
                            window.location = "../subcategorias/mostrar.php?id=' . $idcate . '";
                        });
                      </script>';
            } else {
                $errMSG = "Error al insertar la subcategoría.";
            }
        } else {
            echo '<script type="text/javascript">
                    swal("Error!", "La subcategoría ya existe para esta categoría.", "error").then(function() {
                        window.location = "../subcategorias/nuevo.php";
                    });
                  </script>';
        }
    }
}
?>
