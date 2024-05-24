<?php
   session_start();
   include '../../conn.php';
   
   if(isset($_SESSION['email'])){
   
       $email=$_SESSION['email'];
       $id_rol= $_SESSION['id_rol'];
       
       if($id_rol!=1){
   
           header("Location:  http://localhost/xampp/juan/view/login.php");
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
    <title>admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"  type="text/css" href="../../public/css/admin.css">

</head>
<body>
    <header>

        <div class="container">
            
        <H1> Hello <?php
        
        $fecha_hoy = date("Y-m-d H:i:s");
        echo  "                    ". $fecha_hoy ; ?></H1>
        <a href="#">INCIO</a>
        <a href="../../view/admin/excel.php">INSTRUCTOR</a>
            <form action="../../controller/cerrar.php" method="post">
                <button type="submit" id="cerrar-sesion"><img src="../../public/Img/apagado.png" alt="" width="70%" height="3%"></button>
        </form>
        </div>
    </header>
    <div class="juan">
    <form action="../../controller/exel.php" method="post" enctype="multipart/form-data">
        <h2>Subir Archivo Excel</h2>

       <label class="button">
       <input class="input-file" type="file" name="archivo_excel" id="archivo_excel" accept=".xls,.xlsx">

       <span class="label">Excel</span>
      </label>
      <button >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125" stroke="#fffffff" stroke-width="2"></path>
    <path d="M17 15V18M17 21V18M17 18H14M17 18H20" stroke="#fffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    ADD FILE 
    </button>
    </form>
   <div class="tab">
          <h2>Tabla de Instructores</h2>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Correo</th>
            <th>Teléfono</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM intructores";
        $ress = $conn->query($sql);
        while($row = $ress->fetch_assoc()){
          
          echo "<tr class='tabe'>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['identificaion'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
        echo "</tr>";

              }

      ?>
        </tbody>
      </table>
      <a href="../../controller/exportar.php">exportar</a>
      </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Validar el tipo de archivo al seleccionar
    $(document).ready(function() {
        $('.input-file').change(function() {
            var fileName = $(this).val();
            var allowedExtensions = /(\.xls|\.xlsx)$/i;
            if (!allowedExtensions.exec(fileName)) {
                alert('Por favor, seleccione un archivo con extensión .xls o .xlsx.');
                $(this).val('');
                return false;
            }
        });
    });
</script>

</body>
</html>