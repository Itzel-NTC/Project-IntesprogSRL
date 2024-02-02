<?php
    require_once('../../backend/config/Conexion.php');
if(isset($_POST['delete_items'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `items` WHERE `iditem`=:iditem";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':iditem', $iditem, PDO::PARAM_INT);
$iditem=trim($_POST['iditem']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script type="text/javascript">
swal("Eliminado!", "Se elimino correctamente", "success").then(function() {
            window.location = "../Items/mostrar.php";
        });
        </script>';
}
else{
    echo '<script type="text/javascript">
swal("Error!", "No se pueden agregar datos,  comuníquese con el administrador ", "error").then(function() {
            window.location = "../Items/nuevo.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

