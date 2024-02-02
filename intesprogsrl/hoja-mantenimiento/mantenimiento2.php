<?php
ob_start();
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('location: ../login.php');
}

// Incluye el archivo de conexión
require_once '../backend/config/Conexion.php';
?>

<?php if (isset($_SESSION['id'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>IntesProg SRL</title>
    <link rel="stylesheet" href="../backend/css/admin.css">
    <link rel="icon" type="image/png" href="../backend/img/intesprogsrl_logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../backend/css/font.css">
    <!-- PDF - IMG -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf@3.5.3/dist/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="../hoja-mantenimiento/jspdf.min.js"></script>
    <script src="../app-mantenimiento/app2.js"></script>

    <style type="text/css">
        .loader-container {
        }

        .load_animation {
            width: 100%;
            height: 100vh;
            font-size: 4rem;
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
            transform: translate(-50%, -50%);
            opacity: .5;
            animation: spinner 1s infinite;
            transition: .1s;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes spinner {
            50% {
                transform: translate(-50%, -50%);
                border: 2px solid rgba(0, 0, 0, 0.178);
                padding: 30px;
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -50%) rotate(360deg);
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
            <div class="profile-img bg-img"
                 style="background-image: url(../backend/img/intesprogsrl_logo.png)"></div>
            <h4><?php echo $_SESSION['username']; ?></h4>
            <small>Administrador</small>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="../frontend/administrador/escritorio.php">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                        <a href="../frontend/Items/mostrar.php">
                            <span class="las la-box"></span>
                            <small>Items</small>
                        </a>
                    </li>
                <li>
                    <a href="../frontend/categorias/mostrar.php">
                        <span class="las la-paperclip"></span>
                        <small>Categorias</small>
                    </a>
                </li>
                <li>
                    <a href="../frontend/mantenimiento/mostrar.php" class="active">
                        <span class="las la-tools"></span>
                        <small>Mantenimiento</small>
                    </a>
                </li>
                <li>
                       <a href="../frontend/actividades/mostrar.php">
                            <span class="las la-tasks"></span>
                            <small>Actividades</small>
                        </a>
                    </li>
                <li>
                    <a href="../frontend/accesos/mostrar.php">
                        <span class="las la-user-friends"></span>
                        <small>Accesos</small>
                    </a>
                </li>
                <li>
                    <a href="../frontend/clientes/mostrar.php">
                        <span class="las la-user-friends"></span>
                        <small>Clientes</small>
                    </a>
                </li>
                <li>
                    <a href="../frontend/proveedores/mostrar.php">
                        <span class="las la-user-friends"></span>
                        <small>Proveedores</small>
                    </a>
                </li>

                <li>
                    <a href="../frontend/salir.php">
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
                    <div class="bg-img" style="background-image: url(../backend/img/intesprogsrl_logo.png)"></div>
                </div>
            </div>
        </div>
    </header>

    <main>
            <div class="page-header">
                <h1>Bienvenid@ <?php echo '<strong>' . $_SESSION['nombre'] . '</strong>'; ?></h1>
                <small>Inicio / Hoja de Mantenimiento</small>
            </div>

            <div class="page-content">
                    <h2>Creación para la hoja de vida del mantenimiento</h2>

                    <form method="post">
                    <label for="nombre_mantenimiento">Nombre de la Hoja de Mantenimiento:</label>
<input type="text" name="nombre_mantenimiento" id="nombre_mantenimiento" required>

<label for="cliente">Cliente:</label>
<select name="cliente" id="cliente">
    <?php
        // Consulta para obtener la lista de clientes
        $sql = "SELECT idcli, cliente FROM clientes";
        $result = $connect->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row["idcli"] . '">' . $row["cliente"] . '</option>';
        }
    ?>
</select>


<label for="fiscal_servicio">Fiscal de Servicio:</label>
<input type="text" name="fiscal_servicio" id="fiscal_servicio" readonly>

<label for="servicio">Nombre del servicio que se esta realizando:</label>
<input type="text" name="servicio" id="servicio" required>

<label for="direccion">Dirección:</label>
<input type="text" name="direccion" id="direccion" readonly>


<script>
    document.getElementById('cliente').addEventListener('change', function() {
        var selectedClientId = this.value;

        // Realizar la solicitud AJAX
        fetch('obtener_info_cliente.php?id=' + selectedClientId)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud AJAX');
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos del cliente:', data);

                // Rellenar los campos con la información del cliente
                document.getElementById('fiscal_servicio').value = data.fiscal_servicio;
                document.getElementById('direccion').value = data.direccion;
            })
            .catch(error => console.error('Error al obtener información del cliente:', error));
    });
</script>




    <label for="num_equipo">Número de Equipo:</label>
    <input type="text" name="num_equipo" id="num_equipo" required>

    <label for="marca_equipo">Marca de Equipo:</label>
    <input type="text" name="marca_equipo" id="marca_equipo" required>

    <label for="modelo_equipo">Modelo de Equipo:</label>
    <input type="text" name="modelo_equipo" id="modelo_equipo" required>

    <label for="num_serie">Número de Serie:</label>
    <input type="text" name="num_serie" id="num_serie" required>

    <label for="num_tubos">Número de Tubos:</label>
    <input type="text" name="num_tubos" id="num_tubos" required>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" name="ubicacion" id="ubicacion" required>

    <label for="nivel">Nivel:</label>
    <input type="text" name="nivel" id="nivel" required>

    <label for="fecha_mantenimiento">Fecha de Mantenimiento:</label>
    <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" required>

    <label for="tecnico">Nombre del Personal Técnico:</label>
    <input type="text" name="tecnico" id="tecnico" required>

    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones" rows="4"></textarea>

    <span class="d-block pb-2">Firma digital aqui:</span>
                    <div class="signature mb-2" style="width: 100%; height: 200px;">
                        <canvas id="signature-canvas"
                            style="border: 1px dashed green; width: 100%; height: 200px;"></canvas>
                    </div>
                    <div style="border: 2px solid #D63484; margin-bottom: 20px; background-color: #D63484; padding: 15px; margin-top: 20px; font-size: 16px; color: white;">
    <p>Ya has llenado los datos, continuamos con las actividades de Mantenimiento</p>
</div>

<label for="actividad">Actividad:</label>
<select name="actividad" id="actividad">
    <?php
    // Consulta para obtener la lista de actividades
    $sqlActividades = "SELECT id_actividad, nombre FROM actividades";
    $resultActividades = $connect->query($sqlActividades);

    while ($row = $resultActividades->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row["id_actividad"] . '">' . $row["nombre"] . '</option>';
    }
    ?>
</select>

<!-- <div id="contenedor_subactividades">
    <?php for ($i = 1; $i <= 20; $i++) : ?>
        
        <label for="subactividad<?= $i ?>">Subactividad <?= $i ?>:</label>
        <input type="text" name="subactividad<?= $i ?>" id="subactividad<?= $i ?>" readonly>
    <?php endfor; ?>
    
</div>

 <?php for ($i = 1; $i <= 20; $i++) : ?>
    <label for="obs<?= $i ?>" class="form-label">
        Observación en la subactividad <?= $i ?>:
    </label>
    <div class="form-check form-check-inline">
        <input type="radio" name="obs<?= $i ?>" class="form-check-input obs-checkbox" id="obs-si<?= $i ?>" value="pos">
        <label for="obs-si<?= $i ?>" class="form-check-label">Sí</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" name="obs<?= $i ?>" class="form-check-input obs-checkbox" id="obs-no<?= $i ?>" value="neg">
        <label for="obs-no<?= $i ?>" class="form-check-label">No</label>
    </div>
<?php endfor; ?> -->


 <div id="contenedor_subactividades">
    <?php for ($i = 1; $i <= 20; $i++) : ?>
        <div class="subactividad-container">
            <label for="subactividad<?= $i ?>">Subactividad <?= $i ?>:</label>
            <input type="text" name="subactividad<?= $i ?>" id="subactividad<?= $i ?>" readonly>

        </div>
    <?php endfor; ?>
</div>
<div id="contenedor_obs">
<?php for ($i = 1; $i <= 20; $i++) : ?>
<label for="obs<?= $i ?>" class="form-label">
                Observación en la subactividad <?= $i ?>:
            </label>
            <div class="form-check form-check-inline">
                <input type="radio" name="obs<?= $i ?>" class="form-check-input obs-checkbox" id="obs-si<?= $i ?>" >
                <label for="obs-si<?= $i ?>" class="form-check-label">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="obs<?= $i ?>" class="form-check-input obs-checkbox" id="obs-no<?= $i ?>" >
                <label for="obs-no<?= $i ?>" class="form-check-label">No</label>
            </div>
            <?php endfor; ?>
</div>



<style type="text/css">
    .hidden {
    display: none;
}

    #contenedor_subactividades {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Espaciado entre elementos */
    }

    .subactividad-container {
        display: flex;
        flex-direction: row; /* Coloca subactividad y observación en fila */
        align-items: center; /* Alinea verticalmente */
        margin-bottom: 20px; /* Espaciado inferior entre subactividades */
    }

    .subactividad-container label {
        margin-right: 120px; /* Espaciado derecho entre subactividad y observación */
    }

    .form-check {
        display: flex;
        align-items: center; /* Alinea los elementos verticalmente */
    }

    .form-check input {
        margin-right: 5px; /* Espaciado derecho entre radio buttons y sus etiquetas */
    }

    .form-check label {
        margin-right: 5px; /* Ajusta este valor según sea necesario para mover las observaciones más a la izquierda */
    }
</style>




    <button type="submit" style="background-color: #89A48C; color: white; padding: 12px 20px; border: none; border-radius: 5px; margin-left: 10px;">Generar PDF</button>
</form>

                </div>


                </main>
                <script>
    document.getElementById('actividad').addEventListener('change', function() {
        var selectedActividadId = this.value;

        // Realizar la solicitud AJAX para obtener las subactividades
        fetch('obtener_info_actividad.php?id=' + selectedActividadId)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud AJAX: ' + response.statusText);
                }
                return response.json();
            })
            .then(subactividades => {
                console.log('Subactividades:', subactividades);

                // Rellenar los campos de subactividades en el formulario
                for (let i = 1; i <= 20; i++) {
                    const subactividadInput = document.getElementById('subactividad' + i);
                    if (subactividades[i - 1]) {
                        subactividadInput.value = subactividades[i - 1];
                    } else {
                        subactividadInput.value = '';
                    }
                }
            })
            .catch(error => console.error('Error al obtener subactividades:', error.message));
    });
</script>






<script src="../backend/js/jquery.min.js"></script>
<!-- Data Tables -->
<script type="text/javascript" src="../backend/js/datatable.js"></script>
<script type="text/javascript" src="../backend/js/datatablebuttons.js"></script>
<script type="text/javascript" src="../backend/js/jszip.js"></script>
<script type="text/javascript" src="../backend/js/pdfmake.js"></script>
<script type="text/javascript" src="../backend/js/vfs_fonts.js"></script>
<script type="text/javascript" src="../backend/js/buttonshtml5.js"></script>
<script type="text/javascript" src="../backend/js/buttonsprint.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<script type="text/javascript">
    $(window).on("load", function () {
        $(".load_animation").fadeOut(1000);
    });
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
</html>

<?php } else {
    header('Location: ../login.php');
} ?>