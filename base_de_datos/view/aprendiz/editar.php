<?php
session_start();
include '../../conn.php';

if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $id_rol= $_SESSION['id_rol'];
    $use="SELECT * FROM user WHERE email='$email'";
    $res=$conn->query($use);
    $row=$res->fetch_assoc();
    $id=$row['id'];

    $eta="SELECT * FROM registroetapaproductiva where id_user='$id'";
    $ress=$conn->query($eta);
    $r=$ress->fetch_assoc();

    if($id_rol!=2){
        header("Location:  ../view/login.php");
    }

}else{
    header("Location:  ../view/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapa productiva</title>

    <link rel="stylesheet"  type="text/css" href="../../public/css/editar.css">

</head>
<body>
    <header>

        <div class="containerr">
        <H1> Hello <?php
        date_default_timezone_set('America/Bogota');
        $fecha_hoy = date("Y-m-d H:i:s");
        echo "  " . $email."    ". $fecha_hoy ; ?></H1>
            <form action="../../controller/cerrar.php" method="post">
                <button type="submit" id="cerrar-sesion"><img src="../../public/Img/apagado.png" alt="" width="70%" height="3%"></button>
        </form>
        </div>
    </header>
    <div class="form">
                        <H1> Registro Etapa Productiva  </H1>
        <form action="../../controller/registro_productivo.php" method="post"  id="miFormulario"class="formulario">
            <div class="box">
                <div class="box1">
                    <label for="">Documento de identidad*</label>
                    <input type="number" name="identidad"  placeholder="11082638273"   value="<?php if($ress->num_rows>0){ echo $r['NumeroDocumentoIdentidad']; } ?>" required>
                </div>
                
                <div class="box1">
                    <label for="">nombre completo*</label>
                    <input type="text" name="nombre"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>" required>
                </div>
                
            
                <div class="box1">
                 <label for="">número de ficha*</label>
                    <input type="number" name="ficha"  placeholder="2558068"   value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>" required>
                </div>
                
                
            </div>

            <div class="box">

            <div class="box1">
                 <label for=""> correo electrónico*</label>
                    <input type="email" name="correo"  placeholder="<?php echo $email ?>"   value="<?php if($ress->num_rows>0){ echo $r['CorreoElectronico']; } ?>" required>
                </div>

                <div class="box1">
                     <label for=""> número de su celular o familiar cercano* </label>
                <input type="number" name="celular"  placeholder="35638167347"   value="<?php if($ress->num_rows>0){ echo $r['NumeroCelular']; } ?>" required>
                </div>
                <div class="box1">
                <label for="">nivel académico que esta cursando*</label>
                <select name="nivel" id=""   value="<?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?>" required>
                    <option value=" <?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?>"><?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?></option>
                    <option value="Operario">Operario</option>
                    <option value="Tecnico">Técnico</option>
                    <option value="Tecnologo">Tecnológo</option>
                </select>
                </div>
                
            </div>

            <div class="box">
                <div class="box1">
                <label for="">Programa de formacion*</label> 
                <input type="text" name="programa"  placeholder="Analisis y desarrollo de sofware"   value="<?php if($ress->num_rows>0){ echo $r['ProgramaFormacion']; } ?>" required>
            
                </div>
                <div class="box1">
                <label for="">instructor técnico en la etapa lectiva* </label>
                <input type="text" name="instructor"  placeholder="Sara perez"   value="<?php if($ress->num_rows>0){ echo $r['NombreInstructorLectivo']; } ?>" required>
                </div>
                <div class="box1">
                <label for="">Empresa donde inicia la etapa productiva*</label>
                <input type="text" name="productiva"  placeholder="softonline"   value="<?php if($ress->num_rows>0){ echo $r['EmpresaInicioEtapaProductiva']; } ?>" required>
            
                </div>
            </div>

            <div class="box">
                
                <div class="box1">
                <label for="">Fecha en la que inicio la etapa productiva* <br>
                en la empresa</label>
                <input type="date" name="fechainicio"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>" required>
                </div>
               
           
                <div class="box1">
                <label for="">Fecha en la que termina la etapa <br> productiva en la empresa*</label>
                <input type="date" name="fechacierre"  placeholder="11082638273"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>" required>
                </div>
           
                <div class="box1">
                <label for=""> Municipio o ciudad donde esta realizando <br> la etapa productiva*</label>
                <input type="text" name="ciudad"  placeholder="Ibague"   value="<?php if($ress->num_rows>0){ echo $r['MunicipioCiudad']; } ?>" required>
                </div>
                
            </div>
            <div class="box">

            <div class="box1">
                <label for=""> Direccion Empresa*</label>
                <input type="text" name="direccem"  placeholder="Ibague"   value="<?php if($ress->num_rows>0){ echo $r['DireccionEmpresa']; } ?>" required>
            </div>
                <div class="box1">
                <label for="">Nombre del Jefe Inmediato*</label>
                <input type="text" name="jefe"  placeholder="Carlos Ramirez"   value="<?php if($ress->num_rows>0){ echo $r['NombreJefeInmediato']; } ?>" required>
              
                </div>
                
                <div class="box1">
                <label for="">Número de teléfono del jefe inmediato*</label>
                <input type="number" name="celujefe"  placeholder="31567899876"   value="<?php if($ress->num_rows>0){ echo $r['TelefonoJefeInmediato']; } ?>" required>
                </div>
              
                
               
            </div>
            <div class="box">

            <div class="box1">
                <label for="">correo del jefe inmediato*</label>
                <input type="email" name="correjefe"  placeholder="31567899876"    value="<?php if($ress->num_rows>0){ echo $r['CorreoJefeInmediato']; } ?>" required>
                </div>
              

            <div class="box1">
            <label for="">alternativa de etapa productiva que esta realizando*</label>
                <select name="alternativa" id=""   required>
                    <option value="<?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>">  <?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>  </option>
                    <option value="Contrato de aprendizaje">Contrato de aprendizaje</option>
                    <option value="Vinculo Laboral">Vinculo Laboral</option>
                    <option value="Pasantía - PYME">Pasantía - PYME</option>
                    <option value="Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro">Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro</option>
                    <option value="Proyecto productivo">Proyecto productivo</option>
                    <option value=" Pasantía - Proyecto productivo - Unidad productiva familiar"> Pasantía - Proyecto productivo - Unidad productiva familiar</option>
                    <option value="Monitoría">Monitoría</option>
                </select>
                </div>
                <div class="box1">
                <label for=""> Nombre del Instructor de seguimiento*
                </label>
                <select name="instructoseg" id=""   value="" required>
    <option value="">Seleccione</option>
    <?php
    $sql = "SELECT * FROM intructores";
    $res = $conn->query($sql); 
    while ($row = $res->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    ?>
</select>

            </div>
            </div>
                <input type="text"  name="fecharegi" value="<?php echo date("Y-m-d");  ?> "  id="mi_input" style="display: none;">
                <input type="text"  name="id_user" value="<?php echo $id;  ?> "  id="mi_input" style="display: none;">

                
                
            <div class="confirmar">
                <label>
                    <p>Confirme si ya entregó los documentos de formalización al instructor de seguimiento
                        (Formato-f-GFPI-023-concertación de actividades, Copia del Contrato, Copia de la cédula,
                        EPS, ARL, Formato-f-GFPI-165). Si no los ha entregado, lo invitamos a que lo haga de forma urgente para que quede 
                        formalizada y aceptada su etapa productiva. Debe enviarlos en PDF al correo electrónico del instructor de seguimiento*.</p>
                </label>
                <input aria-posinset="1" aria-setsize="1" aria-labelledby="QuestionChoiceOption17" aria-checked="true" role="checkbox" type="checkbox" class="-hm-81"  name="confirmar" value="Si"   value="<?php if($ress->num_rows>0){ echo $r['NumeroDocumentoIdentidad']; } ?>" required>

            </div>
            <button class="brn" type="submit">

  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        width="24"
        height="24"
      >
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path
          fill="currentColor"
          d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
        ></path>
      </svg>
    </div>
  </div>
  <span>ENVIA</span>
</button>
</form>
    </div>
    <script>
    document.getElementById("miFormulario").addEventListener("submit", function(event) {
    var checkbox = document.querySelector('input[type="checkbox"][name="confirmar"]');
    if (!checkbox.checked) {
        alert("Por favor, confirme que ha entregado los documentos antes de enviar el formulario.");
        event.preventDefault();
    }
});
</script> 
</body>
</html>


