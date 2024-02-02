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
    <!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
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
                       <a href="../Items/mostrar.php" class="active">
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
                <small>Inicio / Items / Nuevo</small>
            </div>
            

<div class="page-content">
    <form action="" enctype="multipart/form-data"  method="POST" autocomplete="off">
        <div class="containerss">
            <h1>Nuevos ítems</h1>
            <!-- Campos del formulario -->
            <label for="serie"><b>Serie</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese la serie" name="serie" required>

            <label for="nombre"><b>Nombre</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese el nombre" name="nombre" required>

            <label for="modelo"><b>Modelo</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese el modelo" name="modelo" required>

            <label for="marca"><b>Marca</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese la marca" name="marca" required>

            <label for="capacidad"><b>Capacidad</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese la capacidad" name="capacidad" required>

            <label for="tipo"><b>Tipo</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese el tipo" name="tipo" required>

            <label for="voltaje"><b>Voltaje</b></label><span class="badge-warning">*</span>
            <input type="text" placeholder="Ingrese el voltaje" name="voltaje" required>

            <hr>

            <button type="submit" name="add_items" class="registerbtn">Guardar</button>
        </div>
    </form>
</div>



            
        </main>
        
    </div>

    <script src="../../backend/js/jquery.min.js"></script>
   
    <script type="text/javascript">
        $(window).on("load",function(){
            $(".load_animation").fadeOut(1000);
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/add_items.php' ?>
    <script type="text/javascript" src="../../backend/js/reenvio.js"></script>
  <script src="../../backend/js/cat.js"></script>
  <script src="../../backend/js/marc.js"></script>
  
</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>