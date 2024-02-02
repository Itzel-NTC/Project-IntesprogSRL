<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>IntesProg SRL</title>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" href="../../backend/img/intesprogsrl_logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">
    <style type="text/css">
 .loader-container{
   
}

.load_animation{
  width: 100%;
  height: 100vh;
  font-size: 4rem ;
  background-color: #fff;
  z-index: 500;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
  
}
.animation {
  position: absolute;
  top: 50%;
  left: 50%;
  border: 3px solid rgb(0, 0, 0);
  border-radius: 50%;
  box-sizing: content-box;
  padding: 10px;
  transform: translate(-50% , -50%) ;
  opacity: .5;
  animation: spinner 1s infinite;
  transition: .1s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
@keyframes spinner {
  50% {
    transform: translate(-50% , -50%) ;
    border: 2px solid rgba(0, 0, 0, 0.178);
    padding: 30px;
  }
  100% {
    opacity: 1;
    transform:translate(-50% , -50%) rotate(360deg);
    border: 3px solid rgba(0, 0, 0, 0);
    padding: 17rem;
    color: #13491E;
  }

}


    </style>

</head>
<body>
    <div class="loader-container">
    <div class="load_animation">
        <ion-icon name="bag-handle-outline" class="animation"></ion-icon>
    </div>
</div>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>IntesProg<span> SRL</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../backend/img/intesprogsrl_logo.png)"></div>
                <h4><?php echo $_SESSION['username']; ?></h4>
                <small>Administrador</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="../administrador/escritorio.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="../Items/mostrar.php">
                            <span class="las la-box"></span>
                            <small>Items</small>
                        </a>
                    </li>
                    <li>
                       <a href="../categorias/mostrar.php">
                            <span class="las la-paperclip"></span>
                            <small>Categorias</small>
                        </a>
                    </li>
                    <li>
                       <a href="../mantenimiento/mostrar.php">
                            <span class="las la-tools"></span>
                            <small>Mantenimiento</small>
                        </a>
                    </li>
                    <li>
                       <a href="../actividades/mostrar.php">
                            <span class="las la-tasks"></span>
                            <small>Actividades</small>
                        </a>
                    </li>
                    <li>
                       <a href="../accesos/mostrar.php">
                            <span class="las la-user-friends"></span>
                            <small>Accesos</small>
                        </a>
                    </li>
                    <li>
                       <a href="../clientes/mostrar.php">
                            <span class="las la-user-friends"></span>
                            <small>Clientes</small>
                        </a>
                    </li>
                    <li>
                       <a href="../proveedores/mostrar.php" class="active">
                            <span class="las la-user-friends"></span>
                            <small>Proveedores</small>
                        </a>
                    </li>
                    <li>
                       <a href="../salir.php">
                            <span class="las la-power-off"></span>
                            <small>Salir</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                
                    <div class="user">
                        <div class="bg-img" style="background-image: url(../../backend/img/intesprogsrl_logo.png)"></div>

                    </div>
                </div>
            </div>
        </header>
        
        <main>
            
            <div class="page-header">
                <h1>Bienvenid@ <?php echo '<strong>'.$_SESSION['username'].'</strong>'; ?></h1>
                <small>Inicio / Proveedores</small>
            </div>
            
            <div class="page-content">
            
            <div class="records table-responsive">
                     <div class="record-header">
                        <div class="add">
                          
                            <button style="cursor: pointer;" onclick="location.href='nuevo.php'">Nuevo</button>
                        </div>
                    </div>
                    <div>
                        <?php 
require '../../backend/config/Conexion.php';
$sentencia = $connect->prepare("SELECT * FROM proveedores ORDER BY idprov DESC;");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
        <table width="100%" id="example">
    <thead>
        <tr>
            <th>#</th>
            <th><span class="las la-sort"></span> Proveedor</th>
            <th><span class="las la-sort"></span> Dirección</th>
            <th><span class="las la-sort"></span> Código Contable</th>
            <th><span class="las la-sort"></span> Código Interno</th>
            <th><span class="las la-sort"></span> Contacto</th>
            <th><span class="las la-sort"></span> Correo Electrónico</th>
            <th><span class="las la-sort"></span> Teléfono</th>
            <th><span class="las la-sort"></span> Moneda por Defecto</th>
            <th><span class="las la-sort"></span> Tipo de IVA</th>
            <th><span class="las la-sort"></span> Plazo de Pago</th>
            <th><span class="las la-sort"></span> Fecha de Registro</th>
            <th><span class="las la-sort"></span> Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d) : ?>
            <tr>
                <td><?php echo $d->idprov ?></td>
                <td><?php echo $d->nombre_proveedor ?></td>
                <td><?php echo $d->direccion ?></td>
                <td><?php echo $d->codigo_contable ?></td>
                <td><?php echo $d->codigo_interno ?></td>
                <td><?php echo $d->nombre_contacto ?></td>
                <td><?php echo $d->correo_contacto ?></td>
                <td><?php echo $d->telefono_contacto ?></td>
                <td><?php echo $d->moneda_por_defecto ?></td>
                <td><?php echo $d->tipo_iva ?></td>
                <td><?php echo $d->plazo_pago ?></td>
                <td><?php echo $d->fecha_registro ?></td>
                <td>
                    <div style="display: flex; align-items: center;">

                        <form onsubmit="return confirm('Realmente desea eliminar el registro?');" method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
                            <input type='hidden' name='idprov' value="<?php echo $d->idprov; ?>">
                            <button name='delete_supplier' style="cursor: pointer; color: #FFF; background-color: #F44336; padding: 5px; border-radius: 5px; display: inline-block; margin-left: 10px;">
                                <div style="font-size: 24px;">
                                    <ion-icon name="trash" style="font-size: inherit; color: #FFF;"></ion-icon>
                                </div>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

                          <?php else:?>
                           <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>
    <script src="../../backend/js/jquery.min.js"></script>
    <!-- Data Tables -->
    <script type="text/javascript" src="../../backend/js/datatable.js"></script>
    <script type="text/javascript" src="../../backend/js/datatablebuttons.js"></script>
    <script type="text/javascript" src="../../backend/js/jszip.js"></script>
    <script type="text/javascript" src="../../backend/js/pdfmake.js"></script>
    <script type="text/javascript" src="../../backend/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonshtml5.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonsprint.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
    <script type="text/javascript">
        $(window).on("load",function(){
            $(".load_animation").fadeOut(1000);
        });
    </script>

     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/delete_supplier.php' ?>
</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>