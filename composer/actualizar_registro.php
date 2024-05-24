<?php
require 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $instructor_2024 = $_POST['INSTRUCTOR_SEGUIMIENTO_ACTUAL'];
    $correo_instructor_2024 = $_POST['Correo_Instructor'];
    $instructor_2023 = $_POST['INSTRUCTOR_ANTERIOR'];
    $correo_instructor_2023 = $_POST['CORREO'];

    $sql = "UPDATE datos_exceldatos1_1714747072 SET 
            INSTRUCTOR_SEGUIMIENTO_ACTUAL = ?, 
            Correo_Instructor = ?, 
            INSTRUCTOR_ANTERIOR = ?, 
            CORREO = ?
            WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$instructor_2024, $correo_instructor_2024, $instructor_2023, $correo_instructor_2023, $id]);

    echo "Datos actualizados correctamente.";
    header("Location: http://localhost/xampp/composer/buscador.php?selected_table=datos_exceldatos1_1714747072&search_value=1");
    exit;
}
?>
