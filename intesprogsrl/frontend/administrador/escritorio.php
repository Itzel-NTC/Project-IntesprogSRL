<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<!DOCTYPE html>
<html lang="es">
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

.pie-chart {
            
  width: 100%;
  padding: 0 10px;
  margin: 0px;
        }
        .text-center{
            text-align: center;
        }

        /* Responsive columns */
@media screen and (max-width: 600px) {
  .pie-chart, .text-center {
    width: 100%;
    display: block;
    margin-bottom: 20px;
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
                <small><?php echo '<strong>'.$_SESSION['nombre'].'</strong>'; ?></small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="escritorio.php" class="active">
                            <span class="las la-home"></span>
                            <small>Panel de control</small>
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
                       <a href="../proveedores/mostrar.php">
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
                <h1>Bienvenid@ <?php echo '<strong>'.$_SESSION['nombre'].'</strong>'; ?></h1>
                <small>Inicio / Panel de Control</small>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                    <div class="card">
                        <div class="card-head">
                            <?php 
                             require_once('../../backend/config/Conexion.php');
                                            $sql = "SELECT COUNT(*) total FROM clientes";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Clientes</small>
                            
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-head">
                            <?php 
                             
                                            $sql = "SELECT COUNT(*) total FROM Items";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-box"></span>
                        </div>
                        <div class="card-progress">
                            <small>Items</small>
                          
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <?php
                            
                                            $sql = "SELECT COUNT(*) total FROM actividades";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-tasks"></span>
                        </div>
                        <div class="card-progress">
                            <small>Actividades</small>
                        
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <?php
                            
                                            $sql = "SELECT COUNT(*) total FROM usuarios";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Accesos</small>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <?php 
                             
                                            $sql = "SELECT COUNT(*) total FROM categoria";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-paperclip"></span>
                        </div>
                        <div class="card-progress">
                            <small>Categorias</small>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <?php 
                             
                                            $sql = "SELECT COUNT(*) total FROM proveedores";
                                            $result = $connect->query($sql); //$pdo sería el objeto conexión
                                            $total = $result->fetchColumn();

                                             ?>
                            <h2><?php echo  $total; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                        <small>Proveedores</small>
                            
                        </div>
                    </div>

                </div>


                <div class="records table-responsive">
                     <div class="record-header">
                        <h1>Clientes nuevos</h1>
                    </div>
                    <div>
                        <?php
$sentencia = $connect->prepare("SELECT * FROM clientes ORDER BY idcli DESC;");
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
            <th><span class="las la-sort"></span> CLIENTE</th>
            <th><span class="las la-sort"></span> FISCAL DE SERVICIO</th>
            <th><span class="las la-sort"></span> DIRECCIÓN</th>
            <th><span class="las la-sort"></span> NOMBRE</th>
            <th><span class="las la-sort"></span> NÚMERO DE CONTACTO</th>
            <th><span class="las la-sort"></span> FECHA</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $d):?>
        <tr>
            <td><?php echo $d->idcli ?></td>
            <td><?php echo $d->cliente ?></td>
            <td><?php echo $d->fiscal_servicio ?></td>
            <td><?php echo $d->direccion ?></td>
            <td><?php echo $d->nombre ?></td>
            <td><?php echo $d->numero_contacto ?></td>
            <td><?php echo $d->fecha ?></td>
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

                <br>
              
                
            </div>

            <!-- <div class="page-content">
            
            <div class="records table-responsive">
                    <div class="record-header">
                        <h1>Gráficas</h1>
                    </div>
                    <div>
    

                <hr>
        <div id="chartDiv" class="pie-chart"></div>  
        <div class="text-center"></div>       
                    </div>

                </div>
                
            </div> -->


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
 
 <script src="https://www.google.com/jsapi"></script>


 <script type="text/javascript">
    window.onload = function() {
        google.load("visualization", "1.1", {
            packages: ["corechart"],
            callback: 'drawChart'
        });
    };
  
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Country', 'Popularity'],
            
            <?php

        $stmt = $connect->prepare("SELECT productos.idprod,productos.codpro ,productos.nomprd, productos.desprd, productos.foto, productos.precio, productos.stock, marca.idmar, marca.nomarc, categoria.idcate, categoria.nocate,productos.modelo, productos.peso, productos.state, productos.fere FROM productos INNER JOIN marca ON productos.idmar = marca.idmar INNER JOIN categoria ON productos.idcate = categoria.idcate");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while($row = $stmt->fetch()) { 
            echo "['".$row['nomprd']."', ".$row['stock']."],";
        }

            ?>

            
        ]);

        var options = {
            pieHole: 0.4,
            title: 'Productos por stock',
        };
  
        var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
        chart.draw(data, options);
    }

</script>


</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>