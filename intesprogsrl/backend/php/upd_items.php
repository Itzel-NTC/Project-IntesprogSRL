<?php  
if (isset($_POST['upd_items'])) {
    // Verificar si 'iditem' está presente en $_POST
    $iditem = isset($_POST['iditem']) ? trim($_POST['iditem']) : null;

    // Verificar si la conexión a la base de datos está establecida
    if (isset($connect)) {
        $serie = trim($_POST['serie']);
        $nombre = trim($_POST['nombre']);
        $modelo = trim($_POST['modelo']);
        $marca = trim($_POST['marca']);
        $capacidad = trim($_POST['capacidad']);
        $tipo = trim($_POST['tipo']);
        $voltaje = trim($_POST['voltaje']);

        try {
            $query = "UPDATE items SET serie=:serie, nombre=:nombre, modelo=:modelo, marca=:marca, capacidad=:capacidad, tipo=:tipo, voltaje=:voltaje WHERE iditem=:iditem LIMIT 1";
            $statement = $connect->prepare($query);

            $data = [
                ':serie' => $serie,
                ':nombre' => $nombre,
                ':modelo' => $modelo,
                ':marca' => $marca,
                ':capacidad' => $capacidad,
                ':tipo' => $tipo,
                ':voltaje' => $voltaje,
                ':iditem' => $iditem
            ];

            $query_execute = $statement->execute($data);

            if ($query_execute) {
                echo '<script type="text/javascript">
                    swal("Actualizado!", "Se actualizó correctamente", "success").then(function() {
                        window.location = "../Items/mostrar.php";
                    });
                </script>';
                exit(0);
            } else {
                echo '<script type="text/javascript">
                    swal("Error!", "No se pueden agregar datos, comuníquese con el administrador", "error").then(function() {
                        window.location = "../Items/mostrar.php";
                    });
                </script>';
                echo 'Error en la actualización: ' . implode(" ", $statement->errorInfo());
                exit(0);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'Error: Conexión a la base de datos no establecida.';
    }
}
?>
