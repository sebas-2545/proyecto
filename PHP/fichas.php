
<?php
session_start();
include ("conexion1.php");
include("config/validate_session.php");
error_reporting(0);





///IMPORTARR


require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
       
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $idficha = "";
                if(isset($Row[0])) {
                    $idficha= mysqli_real_escape_string($conexion,$Row[0]);
                }
                
                $cod_programar = "";
                if(isset($Row[1])) {
                    $cod_programar = mysqli_real_escape_string($conexion,$Row[1]);
                }

                $fechaini = "";
                if(isset($Row[2])) {
                    $fechaini = mysqli_real_escape_string($conexion,$Row[2]);
                }

                $fechafin = "";
                if(isset($Row[3])) {
                    $fechafin = mysqli_real_escape_string($conexion,$Row[3]);
                }

                $jornada = "";
                if(isset($Row[4])) {
                    $jornada = mysqli_real_escape_string($conexion,$Row[4]);
                }

                $horarioini = "";
                if(isset($Row[5])) {
                    $horarioini = mysqli_real_escape_string($conexion,$Row[5]);
                }

                $horariofin = "";
                if(isset($Row[6])) {
                    $horariofin = mysqli_real_escape_string($conexion,$Row[6]);
                }

                $idMunr = "";
                if(isset($Row[7])) {
                    $idMunr= mysqli_real_escape_string($conexion,$Row[7]);
                }

                $idAmbr = "";
                if(isset($Row[8])) {
                    $idAmbr= mysqli_real_escape_string($conexion,$Row[8]);
                }

                $usuarior = "";
                if(isset($Row[9])) {
                    $usuarior= mysqli_real_escape_string($conexion,$Row[9]);
                }
                
                if (!empty($idficha) || !empty($cod_programar)|| !empty($fechaini)|| !empty($fechafin) || !empty($jornada) || !empty($horarioini) || !empty($horariofin) || !empty($idMunr)  || !empty($idAmbr) || !empty($usuarior)) {
                                

                    $query ="INSERT INTO fichas(idficha,cod_programar,fechaini,fechafin,jornada,horarioini,horariofin,idMunr,idAmbr,usuarior )
                    VALUES ('$idficha','$cod_programar','$fechaini','$fechafin','$jornada','$horarioini','$horariofin','$idMunr','$idAmbr','$usuarior')";
           
        


                   $result = mysqli_query($conexion, $query);

                    if (! empty($result)) {
                        $type = "success";
                        $message = "Datos Ingresados con archivo";
                       
                    } else {
                        $type = "success";
                        $message = "Error al importar archivo de Excel1";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "Valide el tipo de archivo y vuelva a subirlo.";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<?php require_once "vista/html/head.php"; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <?php require_once "vista/html/wrapper.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-900 text-center">REGISTRAR FICHAS</h1>
                    <!-- EXCEL  -->
    
    <div class="outer-container">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                 <!-- Botón para subir archivo -->
                 <div class="input-group mb-3">
                 <label class="input-group-text" for="inputGroupFile01">Subir</label> <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import" class="btn btn-success">Registrar</button>
                </div>
                </div>           
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
  


                    
                    
                    <!-- Content Row -->
<!-- BOTON MODAL -->
<div class="row">

<div class="col-sm-12 col-lg-12">
<!-- Button to trigger modal --------------------->
    <button class="btn btn-success" data-toggle="modal" data-target="#modalForm">
    <i class="bi bi-file-binary-fill"></i>   Nueva Ficha
    </button>
</div>
</div>
<!-- FIN BOTON MODAL -->

<!------- MODAL ------->
<div class="col-sm-12 col-lg-12">  
                        <div class="modal fade " id="modalForm" role="dialog" aria-labellebdy="myModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content ">
                                    <!-- Modal Header -->
                                    <div class="modal-header" style="background-color: #198754 !important;">
                                        <h6 class="modal-title" style="color: #fff; text-align: center;" id="myModalLabel">REGISTRAR FICHA</h6>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Cerrar </span>
                                        </button>
                                    </div>
            
                                     <!-- Modal Body -->
                                    <div class="modal-body">
                                     <p class="statusMsg"></p>
                
                                     <form class="form-horizontal" method="POST" action="evento/action/insertarfichas.php">
                <div class="row">
                        <div class="col-sm-12 col-lg-3 ">        

                        <div class="form-group ">
                           <label for="nombre">Id Ficha:</label>
                           <input class="form-control" id="idficha" type="number" name="idficha" required />
                        </div>
                        </div>
                   
                        
                        <div class="col-sm-12 col-lg-9 ">
                   
                       <div class="form-group ">
                           <label for="Codigo">Codigo Programa:</label>
                           <select class="custom-select" id="inputGroupSelect01" name="cod_programar"  id="cod_programar" required>
                            <option selected>Seleccione</option>
                                   <?php
 
                                        $registros = mysqli_query($conexion, "SELECT cod_programa, nom_programa, ver_programa from programas order by nom_programa") or
                                        die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($reg = mysqli_fetch_array($registros)) {
                                        echo "<option value=\"$reg[cod_programa]\">$reg[nom_programa] ver $reg[ver_programa]</option>";
                                        }
                                   ?>
                               </select>
                       </div>
                                    </div>
                </div>
                       
                <div class="row">
                        <div class="col-sm-12 col-lg-6 ">
                       <div class="form-group">
                           <label for="nombre">Fecha de Inicio:</label>
                           <input class="form-control" id="fechaini" type="date" name="fechaini" required/>
                       </div>
                                    </div>
                       <div class="col-sm-12 col-lg-6 ">
                       <div class="form-group">
                           <label for="nombre">Fecha Final:</label>
                           <input class="form-control" id="fechafin" type="date" name="fechafin" required/>
                       </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-lg-4 ">

                       <div class="form-group">
                           <label for="Modalidad">Jornada:</label>
                            <select class="custom-select" id="inputGroupSelect01" name="jornada"  id="jornada" required>
                               <option selected>Seleccione</option>
                               <option value="Mañana">Mañana</option>
                               <option value="Tarde">Tarde</option>
                               <option value="Noche">Noche</option>
                               <option value="Fin de Semana">Fin de Semana</option>
                               <option value="Mixta">Mixta</option>
                            </select>
                       </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 ">
                       <div class="form-group">
                           <label for="nombre">Hora de Inicio:</label>
                           <input class="form-control" id="horarioini" type="time" name="horarioini" required />
                       </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 ">
                       <div class="form-group">
                           <label for="nombre">Hora Final:</label>
                           <input class="form-control" id="horariofin" type="time" name="horariofin"  required/>
                       </div>
                        </div>
                        </div>

                    <div class="row">
                    <div class="col-sm-12 col-lg-6 ">
                                                
                       <div class="form-group">

                       <label for="Rol">Municipio</label>
                            <select class="custom-select" id="inputGroupSelect01" name="idMunr"  id="idMunr" required>
                            <option selected>Seleccione</option>
                                   <?php
 
                                        $registros = mysqli_query($conexion, "SELECT idMun,nomMun from municipios order by idMun") or
                                        die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($reg = mysqli_fetch_array($registros)) {
                                        echo "<option value=\"$reg[idMun]\">$reg[nomMun]</option>";
                                        }
                                   ?>
                               </select>
                       </div>
                        </div>
                
                    <div class="col-sm-12 col-lg-6 ">
                       <div class="form-group">
                       <label for="Rol">Ambiente :</label>
                            <select class="custom-select" id="inputGroupSelect01" name="idAmbr"  id="idAmb" required>
                            <option selected>Seleccione</option>
                                   <?php
 
                                        $registros = mysqli_query($conexion, "SELECT *from ambientes order by numAmb") or
                                        die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($reg = mysqli_fetch_array($registros)) {
                                        echo "<option value=\"$reg[numAmb]\">$reg[numAmb] Nave $reg[naveAmb] $reg[nomAmb]</option>";
                                        }
                                   ?>
                               </select>
                       </div>
                        </div>
                        </div>
                        <div class="row">
                    <div class="col-sm-12 col-lg-12 ">
                       <div class="form-group">
                       <label for="Rol">Gerente de Grupo:</label>
                            <select class="custom-select" id="inputGroupSelect01" name="usuarior"  id="usuarior" required>
                            <option selected>Seleccione</option>
                                   <?php
 
                                        $registros = mysqli_query($conexion, "SELECT usuario, nom_usuario, ape_usuario from usuarios order by nom_usuario") or
                                        die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($reg = mysqli_fetch_array($registros)) {
                                        echo "<option value=\"$reg[usuario]\">$reg[nom_usuario] $reg[ape_usuario] - $reg[usuario] </option>";
                                        }
                                   ?>
                               </select>
                       </div>
                     </div>
                     </div>
                        
                        
            </div>
            
            <!-- Modal Footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" name="registrar" class="btn btn-success submitBtn"><i class="bi bi-box-arrow-right"></i> Registrar</button>
			</div>

                </form>
                                 </div>
                            </div>
			            </div>
		
            </div>
           

                </div>
<!------- FIN MODAL -------> 

                 <!-- /.container-fluid -->
                 <?php
                        include_once('conexion1.php');
                        $sqlCliente   = ("SELECT *FROM fichas,programas,municipios,usuarios where cod_programar=cod_programa and idMun=idMunr and usuarior=usuario ");
                        $queryCliente = mysqli_query($conexion, $sqlCliente);
                        $cantidad     = mysqli_num_rows($queryCliente);
                        ?>


                       
                    <div class="container-fluid">

<!----------- TABLAS MOSTRAR ------------------>

<!-- Page Heading -->
                


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success text-center">FICHAS REGISTRADAS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="5">
                                    <thead class="thead bg-success ">
                                        <tr>
                                                 <th scope="col" class="text-center text-white">Ficha</th>
                                                 <th scope="col" class="text-center text-white">Programa</th>
                                                 <th scope="col" class="text-center text-white">Fecha de Inicio</th>
                                                 <th scope="col" class="text-center text-white">Fecha Final</th>
                                                 <th scope="col" class="text-center text-white">Jornada</th>
                                                 <th scope="col" class="text-center text-white">Hora Inicio</th>
                                                 <th scope="col" class="text-center text-white">Hora Fin</th>
                                                 <th scope="col" class="text-center text-white">Municipio</th>
                                                 <th scope="col" class="text-center text-white">Ambiente</th>
                                                 <th scope="col" class="text-center text-white">Nombre Gerente de Grupo</th>
                                                 <th scope="col" class="text-center text-white">Apellido Gerente de Grupo</th>
                                                 <th scope="col" class="text-center text-white">Opciones</th>          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($dataCliente = mysqli_fetch_array($queryCliente)) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $dataCliente['idficha']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['nom_programa']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['fechaini']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['fechafin']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['jornada']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['horarioini']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['horariofin']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['nomMun']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['idAmbr']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['nom_usuario']; ?></td>
                                                <td class="text-center"><?php echo $dataCliente['ape_usuario']; ?></td>
                                                <td> 
                                                <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#editFicha<?php echo $dataCliente['idficha']; ?>">
                                                <i class="bi bi-pencil-square"></i>
                                                </button></center>
                                                <!--Boton Eliminar--
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deletePrograma<?php echo $dataCliente['idficha']; ?>">
                                                <i class="bi bi-box-arrow-in-down"></i>
                                                </button>->
                                                </td>
                                            </tr>
                                                    <!--Ventana Modal para Actualizar--->
                                                    <?php  include('editar/ModalEditarFicha.php'); ?>

                                                    <!--Ventana Modal para la Alerta de Eliminar--->
                                                    <?php include('eliminar/ModalEliminarFicha.php'); ?>
                                                    <?php } ?>
                
                                                                
                                    <!-- /.container-fluid -->
                                 
                                       

        

                                    </tbody>
                                    

                                </table>
                            </div>
                        </div>
                    </div>

                
                </div>
           
            <!-- End of Main Content -->


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Centro de Industria y Construcción - 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

<!----------- FIN TABLAS MOSTRAR ------------------>



                
               
        </div>
    </div>
			</div>
			</div>
</div>
</div>

                                             
                           
                            



                    

                
      
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal de Salir -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Clic en Salir para cerrar la sesión .</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-success" href="salir.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

     <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>