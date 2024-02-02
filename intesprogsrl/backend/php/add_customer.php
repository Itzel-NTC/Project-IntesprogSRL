<?php
require_once('../../backend/config/Conexion.php'); 

if(isset($_POST['add_customer']))
{
    $cliente = trim($_POST['cliente']);
    $fiscal_servicio = trim($_POST['fiscal_servicio']);
    $direccion = trim($_POST['direccion']);
    $nombre = trim($_POST['nombre']);
    $numero_contacto = trim($_POST['numero_contacto']);

    if(empty($cliente) || empty($fiscal_servicio) || empty($direccion) || empty($nombre) || empty($numero_contacto)){
        echo '<script type="text/javascript">
        swal("Error!", "Por favor, complete todos los campos requeridos.", "error");
        </script>';
    }
    else
    {  
        $sql = "SELECT * FROM clientes WHERE fiscal_servicio = :fiscal_servicio OR numero_contacto = :numero_contacto";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':fiscal_servicio', $fiscal_servicio);
        $stmt->bindParam(':numero_contacto', $numero_contacto);
        $stmt->execute();

        if ($stmt->fetchColumn() == 0) 
        {
            $sqlInsert = "INSERT INTO clientes(cliente, fiscal_servicio, direccion, nombre, numero_contacto) 
                          VALUES(:cliente, :fiscal_servicio, :direccion, :nombre, :numero_contacto)";

            $stmtInsert = $connect->prepare($sqlInsert);
            $stmtInsert->bindParam(':cliente', $cliente);
            $stmtInsert->bindParam(':fiscal_servicio', $fiscal_servicio);
            $stmtInsert->bindParam(':direccion', $direccion);
            $stmtInsert->bindParam(':nombre', $nombre);
            $stmtInsert->bindParam(':numero_contacto', $numero_contacto);

            if($stmtInsert->execute())
            {
                echo '<script type="text/javascript">
                swal("¡Registrado!", "Se ha agregado correctamente.", "success").then(function() {
                    window.location = "../clientes/mostrar.php";
                });
                </script>';
            }
            else
            {
                echo '<script type="text/javascript">
                swal("Error!", "Ocurrió un error al insertar.", "error");
                </script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">
            swal("Error!", "Datos duplicados no se aceptan. Comuníquese con el administrador.", "error");
            </script>';
        }
    }
}
?>
