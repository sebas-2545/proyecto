<?php
session_start();
include '../../conn.php';

if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $id_rol= $_SESSION['id_rol'];
    if($id_rol!=5){
        header("Location:  http://localhost/xampp/juan/view/login.php");
    }
    
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    $sql="SELECT * FROM registroetapaproductiva WHERE id='$id'";
    
    $ress= $conn->query($sql);
    $r=$ress->fetch_assoc();
    $tt=$r['id_intructor'];
    $sq="SELECT * FROM intructores WHERE id='$tt'";
    $s = $conn->query($sq);
    $rr= $s->fetch_assoc();
    $te=$r['Id'];
    $extt ="Pdf";
    $url='../../controller/pdf.php?id='.$te;
    $tarea='../../controller/tarea.php?id='. $id . "&PENDIENTE=" . "PENDIENTE";
    }
}else{
    header("Location:  http://localhost/xampp/juan/view/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapa productiva</title>

    <link rel="stylesheet"  type="text/css" href="../../public/css/index.css">

</head>
<body>
    

    <form action="../../controller/responder.php" method="post">
    <input type="text"  name="id" value=" <?php echo $id  ?>"id="mi_input" style="display: none;">
    <input type="text"  name="tarea" value="RESPONDIDA"id="mi_input" style="display: none;">

        <div class="Cuadra">
            <div class="fi">
                <div class="input-container">
                    <input type="number" class="input-field"  name="identidad" id="" value="<?php if($ress->num_rows>0){ echo $r['NumeroDocumentoIdentidad']; } ?>" readonly >
                    <label for="input-field" class="input-label">Documento de Identidad </label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="text"  class="input-field"  name="nombre" id=""  value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>">
                    <label for="input-field" class="input-label">NOMBRE DEL APRENDIZ</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="email" class="input-field" value="<?php if($ress->num_rows>0){ echo $r['CorreoElectronico']; } ?>" name="correo">
                    <label for="input-field" class="input-label">Correo</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="number" class="input-field" name="celular" id="" value="<?php if($ress->num_rows>0){ echo $r['NumeroCelular']; } ?>" >
                    <label for="input-field" class="input-label">Celular</label>
                    <span class="input-highlight"></span>
                </div>
            </div>
            <div class="fi">
              <div class="input-container">
                    <input type="number" class="input-field" name="ficha" value="<?php if($ress->num_rows>0){ echo $r['NumeroFicha']; } ?>" >
                    <label for="input-field" class="input-label">FICHA</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                <select name="nivel" id="" >
                        <option  value="<?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?> "><?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?></option>
                        <option  value="Tecnico">Tecnico</option>
                        <option  value="Tecnologo">Tecnologo</option>
                        <option  value="Operario">Operario</option>
                     </select>
                    <label for="input-field" class="input-label">TIPO DE FORMACIÓN</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="text" name="programa" class="input-field"  placeholder="Analisis y desarrollo de sofware"   value="<?php if($ress->num_rows>0){ echo $r['ProgramaFormacion']; } ?>" required>
                    <label for="input-field" class="input-label">PROGRAMA FORMACIÓN</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="text" name="instructor" class="input-field" id="" value="<?php if($ress->num_rows>0){ echo $r['NombreInstructorLectivo']; } ?>">
                    <label for="input-field" class="input-label">Instructor técnico etapa lectiva</label>
                    <span class="input-highlight"></span>
                </div>
            </div>
            <div class="fi">
              <div class="input-container">
                    <input type="text" name="productiva" id="" class="input-field" value="<?php if($ress->num_rows>0){ echo $r['EmpresaInicioEtapaProductiva']; } ?>">
                    <label for="input-field" class="input-label">Nombre Empresa</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="text" name="direccem" class="input-field" id="" value="<?php if($ress->num_rows>0){ echo $r['DireccionEmpresa']; } ?>">
                    <label for="input-field" class="input-label">Dirección de la empresa</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="date" name="fechainicio"  class="input-field" placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>">
                    <label for="input-field" class="input-label">Fecha Inicio</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                   <input type="date" name="fechacierre" class="input-field"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['FechaFinEtapa']; } ?>">
                    <label for="input-field" class="input-label">Fecha Fin</label>
                    <span class="input-highlight"></span>
                </div>
                
            </div>
            <div class="fi">
                <div class="input-container">
                    <input type="text" name="jefe" id=""  class="input-field" value="<?php if($ress->num_rows>0){ echo $r['NombreJefeInmediato']; } ?>">
                    <label for="input-field" class="input-label">Nombre Supervisor</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                     <input type="tel" name="celujefe" class="input-field" id="" value="<?php if($ress->num_rows>0){ echo $r['TelefonoJefeInmediato']; } ?>">
                    <label for="input-field" class="input-label">Celular</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input type="email" name="correjefe" class="input-field" id="" value="<?php if($ress->num_rows>0){ echo $r['CorreoJefeInmediato']; } ?>">
                    <label for="input-field" class="input-label">Correo</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                     <input type="text" name="ciudad"  class="input-field" value="<?php if($ress->num_rows>0){ echo $r['MunicipioCiudad']; } ?>" id="">
                    <label for="input-field" class="input-label">Municipio</label>
                    <span class="input-highlight"></span>
                </div>
            </div>
            <div class="fi">
            
            <div class="input-container">
            <select name="alternativa" id=""  required>
                            <option value="<?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>"    >   <?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>  </option>
                            <option value="Contrato de aprendizaje">Contrato de aprendizaje</option>
                            <option value="Vinculo Laboral">Vinculo Laboral</option>
                            <option value="Pasantía - PYME">Pasantía - PYME</option>
                            <option value="Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro">Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro</option>
                            <option value="Proyecto productivo">Proyecto productivo</option>
                            <option value=" Pasantía - Proyecto productivo - Unidad productiva familiar"> Pasantía - Proyecto productivo - Unidad productiva familiar</option>
                            <option value="Monitoría">Monitoría</option>
                        </select>
                    <label for="input-field" class="input-label">Alternativa Etapa Productiva</label>
                    <span class="input-highlight"></span>
            </div>
            <div class="input-container">
            <select name="instructoseg" id=""   required>
                <option value="<?php if($ress->num_rows>0){ echo $rr['id']; } ?>"><?php if($ress->num_rows>0){ echo $rr['name']; } ?></option>
                <?php
                $sql = "SELECT * FROM intructores";
                $res = $conn->query($sql); 
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
                    <label for="input-field" class="input-label">Instructor De Seguimiento</label>
                    <span class="input-highlight"></span>
            </div>
         
            </div>
    </div>
    <h2>FECHAS DE SEGUIMIENTOS</h2>

    <div class="Cuadraa">
        
    <div class="fi">
           <div class="input-container">
                <input type="date" name="fecres" class="input-field"  value="<?php if($ress->num_rows>0){ echo $r['Registroetapaproductiva']; } ?>"  >
                <label for="input-field" class="input-label">Registro etapa productiva en senasofiaplus</label>
                <span class="input-highlight"></span>
            </div>
            <div class="input-container">
                <input type="date" name="fechaform" class="input-field"  value="<?php if($ress->num_rows>0){ echo $r['FechaFormalizacion']; } ?>" required>
                <label for="input-field" class="input-label">Fecha de Formalización*</label>
                <span class="input-highlight"></span>
            </div>
            <div class="input-container">
                <input type="date" name="fechacerti" class="input-field" value="<?php if($ress->num_rows>0){ echo $r['FechaEstadoPorCertificar']; } ?>" required>
                <label for="input-field" class="input-label">Fecha de Estado Por Certificar*</label>
                <span class="input-highlight"></span>
            </div>
           
            </div>
    <div class="fi">
          <div class="input-container">
                <textarea type="text" name="respuesta" id="text"class="input-field"  value="<?php if($ress->num_rows>0){ echo $r['Respuesmagna']; } ?>"  ></textarea>
                <label for="input-field" class="input-label">Respuesta Magna</label>
                <span class="input-highlight"></span>
            </div>
            
            <div class="input-container">
                    <input type="date" name="fechaeva" class="input-field"  value="<?php if($ress->num_rows>0){ echo $r['FechaEvaluacionParcial']; } ?>" required>
                    <label for="input-field" class="input-label">Fecha de evaluacion parcial*</label>
                    <span class="input-highlight"></span>
            </div>
            
            <div class="input-container">
                 <input type="date" name="fechares" class="input-field" value="<?php if($ress->num_rows>0){ echo $r['FechaRespuestaCertificacion']; } ?>" required>
                <label for="input-field" class="input-label">Fecha Respuesta Certificación*</label>
                <span class="input-highlight"></span>
            </div>
           
            
        </div>
            <div class="tkk">

            <div class="input-container">
                <input type="date" name="fechafin" class="input-field" value="<?php if($ress->num_rows>0){ echo $r['FechaEvaluacionFinal']; } ?>" required>
                <label for="input-field" class="input-label">Fecha de Evaluación Final*</label>
                <span class="input-highlight"></span>
            </div>
                <div class="input-container">
                    <?php
                    if($ress->num_rows > 0) {
                        $enlace = $r['URLFormulario'];
                    } else {
                        $enlace = ""; 
                    }
                    ?>
                    <input type="text" name="link" class="input-field" value="<?php echo $enlace; ?>" onclick="irAEnlace('<?php echo $enlace; ?>')" required>
                    <label for="input-field" class="input-label">LINK</label>
                    <span class="input-highlight"></span>
                </div>

<script>
    function irAEnlace(enlace) {
        window.location.href = enlace;
    }
</script>
            </div>
        </div>
        <div class="tabla">
            
           <div class="esta">
               <label for="">Estado*
                    <select name="est" id="" require>
                       <option value="<?php if($ress->num_rows>0){ echo $r['Estado']; } ?>"><?php if($ress->num_rows>0){ echo $r['Estado']; } ?></option>
                        <option value="FORMALIZADO">FORMALIZADO</option>
                        <option value="FALTA RESULTADOS">FALTA RESULTADOS</option>
                        <option value="RETIRO VOLUNTARIO">RETIRO VOLUNTARIO</option>
                        <option value="CANCELACION MTRICULA">CANCELACION MTRICULA</option>
                        <option value="DESERTADO">DESERTADO</option>
                        <option value="CAMBIO ALTERNATIVA">CAMBIO ALTERNATIVA</option>
                        <option value="CERTIFICADO">CERTIFICADO</option>
                        <option value="POR CERTIFICAR">POR CERTIFICAR</option>
                        <option value="REVISION">REVISION</option>
                    </select>  
                    </label>
                  
               <div class="relative">
                   <input id="input" class="input-cal input-base" type="date"name="fechapaz" value="<?php if($ress->num_rows>0){ echo $r['FechaSolicitudPazySalvo']; } else{
                       echo "null"; } ?>" required>

                    <label id="label-input">Fecha Solicitud Paz y salvo</label>
                 </div>
                 <div class="relative">
                    <input id="input" class="input-cal input-base" type="date" name="respuestacor"  value="<?php if($ress->num_rows>0){ echo $r['FechaRespuestaCoordinador']; } ?>"  required>

                    <label id="label-input">Fecha Respuesta Coordinador</label>
                 </div>
             
               </div>
        <table>
            <thead>
                <tr>
                    <th>Evidencia / Lista de Chequeo</th>
                    <th>CUMPLE</th>
                    <th>NO CUMPLE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td>1_Formato GFPI-F-023 Planeación</td>
                    <td><input type="radio" name="form023" value="si" <?php if ($r['FormatoGFPIF023'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="form023" value="no" <?php if ($r['FormatoGFPIF023'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>2 _Contrato de aprendizaje </td>
                    <td><input type="radio" name="dos" value="si" <?php if ($r['CopiaContrato'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="dos" value="no" <?php if ($r['CopiaContrato'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    
                    <td>3_Formato GFPI-F-165 Selección EP</td>
                    <td><input type="radio" name="form165" value="si" <?php if ($r['FormatoGFPIF165'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="form165" value="no" <?php if ($r['FormatoGFPIF165'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>4_Cámara de comercio o RUT de la empresa 
                    </td>
                    <td><input type="radio" name="rut" value="si" <?php if ($r['RUToNIT'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="rut" value="no" <?php if ($r['RUToNIT'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>5_Certificación EPS</td>
                    <td><input type="radio" name="eps" value="si" <?php if ($r['EPS'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="eps" value="no" <?php if ($r['EPS'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>6_Certificación ARL</td>
                    <td><input type="radio" name="arl" value="si"  <?php if ($r['ARL'] == 'si') echo 'checked'; ?> required ></td>
                     <td><input type="radio" name="arl" value="no" <?php if ($r['ARL'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>7_Formato GFPI-F-023 Evaluaciones (Parcial y Final)</td>
                    <td><input type="radio" name="form23par" value="si" <?php if ($r['FormatoGFPIF023Completo'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="form23par" value="no" <?php if ($r['FormatoGFPIF023Completo'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>8_Formato GFPI-F-147 Bitácoras</td>
                    <td> <input type="text" name="bita" value="<?php if($ress->num_rows>0){ echo $r['FormatoGFPIF147Bitacoras']; } ?>" required> </td>
                    <td>  </td>
                </tr>
                <tr>
                    <td>9_Certificación Final de Etapa Productiva</td>
                    <td><input type="radio" name="certifina" value="si" <?php if ($r['CertificacionFinalizacion'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="certifina" value="no" <?php if ($r['CertificacionFinalizacion'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>10_Juicio Evaluativo Reporte</td>
                    <td><input type="radio" name="tres" value="si" <?php if ($r['EstadoPorCertificar'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="tres" value="no" <?php if ($r['EstadoPorCertificar'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>11_Documento Identidad</td>
                    <td><input type="radio" name="copi" value="si" <?php if ($r['CopiaCedula'] == 'si') echo 'checked'; ?> required ></td>
                     <td><input type="radio" name="copi" value="no" <?php if ($r['CopiaCedula'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>12_Certificado TyT </td>
                    <td><input type="radio" name="tyt" value="si" <?php if ($r['PruebasTyT'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="tyt" value="no" <?php if ($r['PruebasTyT'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>13_Certificación Carnet </td>
                    <td><input type="radio" name="carnet" value="si" <?php if ($r['DestruccionCarnet'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="carnet" value="no" <?php if ($r['DestruccionCarnet'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                <tr>
                    <td>14_Certificado APE </td>
                    <td><input type="radio" name="ape" value="si" <?php if ($r['CertificadoAPE'] == 'si') echo 'checked'; ?> required ></td>
                    <td><input type="radio" name="ape" value="no" <?php if ($r['CertificadoAPE'] == 'no') echo 'checked'; ?> required ></td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="observacion">
                    <h3>Observaciones</h3>
                    <input name="observacion" value="<?php echo $r['observaciones']?>"  >
             </div>
        <div class="botones">
           
             <div class="button" onclick="location.href='<?php echo $url;?>';">
                <span class="button__text">PDF</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
             </div>
            <button class="brn" type="submit">
            <div class="button" >
                <span class="button__text">RESPONDER</span>
                     <span class="button__icon"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path
                        fill="currentColor"
                        d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                        ></path>
                    </svg></span>
            </div>
            </button>
            <div class="button" onclick="location.href='<?php echo './lider.php' ?>'">
                <span class="button__text">Salir </span>
                <span class="button__icon">  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg></span>
             </div>
        </div>
        

        </form>
</body>
</html>


