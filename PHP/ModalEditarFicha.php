
<!--ventana para Update--->
<div class="modal fade" id="editFicha<?php echo $dataCliente['idficha']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #198754 !important;">
        <h6 class="modal-title" style="color: #fff; text-align: center;">
            ACTUALIZAR FICHA
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <form method="POST" action="editar/recib_Updateficha.php">
        <input type="hidden" name="idficha" value="<?php echo $dataCliente['idficha']; ?>">

            <div class="modal-body" id="cont_modal">

            <div class="row">
                        <div class="col-sm-12 col-lg-3 ">        

                        <div class="form-group ">
                           <label for="nombre">Id Ficha:</label>
                           <input class="form-control" id="idficha" type="number" name="idficha" value="<?php echo $dataCliente['idficha']; ?>" readonly/>
                        </div>
                        </div>
                   
                        
                        <div class="col-sm-12 col-lg-9 ">
                   
                       <div class="form-group ">
                           <label for="Codigo">Codigo Programa:</label>
                           <select class="custom-select" id="inputGroupSelect01" name="cod_programar"  id="cod_programar" required>
                           <option value="<?php echo $dataCliente['cod_programar'];?>"><?php echo $dataCliente['cod_programar']?></option>
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
                           <input class="form-control" id="fechaini" type="date" name="fechaini" onchange="obtenerFecha(this)" value="<?php echo $dataCliente['fechaini']; ?>" required="true"/>
                       </div>
                                    </div>
                       <div class="col-sm-12 col-lg-6 ">
                       <div class="form-group">
                           <label for="nombre">Fecha Final:</label>
                           <input class="form-control" id="fechafin" type="date" name="fechafin" onchange="obtenerFecha(this)" value="<?php echo $dataCliente['fechafin']; ?>" required="true"/>
                       </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-lg-4 ">

                       <div class="form-group">
                           <label for="Modalidad">Jornada:</label>
                            <select class="custom-select" id="inputGroupSelect01" name="jornada"  id="jornada" required>
                            <option value="<?php echo $dataCliente['jornada'];?>"><?php echo $dataCliente['jornada']?></option>
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
                           <input class="form-control" id="horarioini" type="time" name="horarioini" value="<?php echo $dataCliente['horarioini']; ?>" required />
                       </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 ">
                       <div class="form-group">
                           <label for="nombre">Hora Final:</label>
                           <input class="form-control" id="horariofin" type="time" name="horariofin" value="<?php echo $dataCliente['horariofin']; ?>" required/>
                       </div>
                        </div>
                        </div>

                    <div class="row">
                    <div class="col-sm-12 col-lg-6 ">
                                                
                       <div class="form-group">

                       <label for="Rol">Municipio</label>
                            <select class="custom-select" id="inputGroupSelect01" name="idMunr"  id="idMunr" required>
                            <option value="<?php echo $dataCliente['idMunr'];?>"><?php echo $dataCliente['idMunr']?></option>
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
                            <option value="<?php echo $dataCliente['idAmbr'];?>"><?php echo $dataCliente['idAmbr']?></option>
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
                            <option value="<?php echo $dataCliente['usuarior'];?>"><?php echo $dataCliente['usuarior']?></option>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->
