<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unicen-formulario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger los datos del formulario
$Fecha_hora = $_POST['Fecha_hora'];
$Carrera = $_POST['carrera'];
$apellido_nombre = $_POST['apellido_nombre'];
$fecha_egreso = $_POST['fecha_egreso'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$ciudad = $_POST['ciudad'];
$situacion_laboral = $_POST['situacion_laboral'];
$empresa = $_POST['empresa'];
$localidadempresa = $_POST['localidadempresa'];
$cargo = $_POST['cargo'];
$area = $_POST['area'];
$mail = $_POST['mail'];
$relaciontrabajo = $_POST['relaciontrabajo'];
$vinculacion = $_POST['vinculacion'];
$Actividad = $_POST['Actividad'];
$Docente = $_POST['Docente'];
$Departamento_docente = $_POST['Departamento_docente'];
$becario = $_POST['becario'];
$no_docente = $_POST['no_docente'];
$desocupado = $_POST['desocupado'];
$capacitarse = $_POST['capacitarse'];
$acompanar = $_POST['acompanar'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO formulario_etapas (Fecha_hora, Carrera, apellido_nombre, fecha_egreso, telefono, correo, ciudad, situacion_laboral, empresa, localidadempresa, cargo, area, mail, relaciontrabajo, vinculacion, Actividad, Docente, Departamento_docente, becario, no_docente, desocupado, capacitarse, acompanar) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssss", $Fecha_hora, $Carrera, $apellido_nombre, $fecha_egreso, $telefono, $correo, $ciudad, $situacion_laboral, $empresa, $localidadempresa, $cargo, $area, $mail, $relaciontrabajo, $vinculacion, $Actividad, $Docente, $Departamento_docente, $becario, $no_docente, $desocupado, $capacitarse, $acompanar);

if ($stmt->execute()) {
    echo "Formulario enviado correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
