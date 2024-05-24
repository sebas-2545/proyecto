
<?php
include ("../conexion1.php");
$idficha = $_REQUEST['idficha'];
$cod_programar      = $_REQUEST['cod_programar'];
$fechaini 	 = $_REQUEST['fechaini'];
$fechafin 	 = $_REQUEST['fechafin'];
$jornada 	 = $_REQUEST['jornada'];
$horarioini 	 = $_REQUEST['horarioini'];
$horariofin 	 = $_REQUEST['horariofin'];
$idMunr 	 = $_REQUEST['idMunr'];
$idAmbr	 = $_REQUEST['idAmbr'];
$usuarior 	 = $_REQUEST['usuarior'];



$update = ("UPDATE fichas
	SET 
	idficha  ='" .$idficha. "',
	cod_programar  ='" .$cod_programar. "',
	fechaini  ='" .$fechaini. "',
	fechafin  ='" .$fechafin. "',
	jornada ='" .$jornada. "',
	horarioini ='" .$horarioini. "',
	horariofin ='" .$horariofin. "',
	idMunr ='" .$idMunr. "',
	idAmbr ='" .$idAmbr. "',
	usuarior ='" .$usuarior. "'
	

WHERE idficha='" .$idficha. "'
");
$result_update = mysqli_query($conexion, $update);

echo "<script type='text/javascript'>
        window.location='../fichas.php';
    </script>";

?>
