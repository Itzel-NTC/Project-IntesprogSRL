<?php
require_once('../../backend/config/Conexion.php');

if (isset($_POST['add_supplier'])) {
    $nomprv = trim($_POST['nomprv']);
    $dirprv = trim($_POST['dirprv']);
    $codcont = trim($_POST['codcont']);
    $codint = trim($_POST['codint']);
    $nomcont = trim($_POST['nomcont']);
    $corcont = trim($_POST['corcont']);
    $telcont = trim($_POST['telcont']);
    $moneda = trim($_POST['moneda']);
    $tipo_iva = trim($_POST['tipo_iva']);
    $plazo_pago = trim($_POST['plazo_pago']);

    if (empty($nomprv) || empty($dirprv) || empty($codcont) || empty($codint) || empty($nomcont) || empty($telcont) || empty($moneda) || empty($tipo_iva) || empty($plazo_pago)) {
        $errMSG = "Por favor, complete los campos obligatorios.";
    } else {
        // Validamos primero que el proveedor no exista
        $sql = "SELECT * FROM proveedores WHERE nombre_proveedor = '$nomprv'";
        $stmt = $connect->prepare($sql);
        $stmt->execute();

        if ($stmt->fetchColumn() == 0) {
            // Si no existe, procedemos a insertar
            $stmt = $connect->prepare("INSERT INTO proveedores (nombre_proveedor, direccion, codigo_contable, codigo_interno, nombre_contacto, correo_contacto, telefono_contacto, moneda_por_defecto, tipo_iva, plazo_pago) VALUES (:nomprv, :dirprv, :codcont, :codint, :nomcont, :corcont, :telcont, :moneda, :tipo_iva, :plazo_pago)");
            $stmt->bindParam(':nomprv', $nomprv);
            $stmt->bindParam(':dirprv', $dirprv);
            $stmt->bindParam(':codcont', $codcont);
            $stmt->bindParam(':codint', $codint);
            $stmt->bindParam(':nomcont', $nomcont);
            $stmt->bindParam(':corcont', $corcont);
            $stmt->bindParam(':telcont', $telcont);
            $stmt->bindParam(':moneda', $moneda);
            $stmt->bindParam(':tipo_iva', $tipo_iva);
            $stmt->bindParam(':plazo_pago', $plazo_pago);

            if ($stmt->execute()) {
                echo '<script type="text/javascript">
                        swal("¡Registrado!", "Se agregó correctamente", "success").then(function() {
                            window.location = "../proveedores/mostrar.php";
                        });
                      </script>';
            } else {
                $errMSG = "Error al insertar el registro.";
            }
        } else {
            echo '<script type="text/javascript">
                    swal("Error!", "El proveedor ya existe", "error").then(function() {
                        window.location = "../proveedores/nuevo.php";
                    });
                  </script>';
        }
    }
}
?>
