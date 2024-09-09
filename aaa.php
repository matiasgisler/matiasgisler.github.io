<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: auth.php'); // Redirigir a la página de inicio de sesión
    exit;
}

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

// Procesar la subida del archivo CSV
if (isset($_POST['upload']) && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        // Leer la primera línea (encabezado)
        $header = fgetcsv($handle);

        // Comenzar una transacción
        $conn->begin_transaction();

        // Preparar la consulta de eliminación
        $sql_delete = "DELETE FROM formulario_etapas WHERE apellido_nombre = ?";
        $stmt_delete = $conn->prepare($sql_delete);

        // Preparar la consulta de inserción
        $sql_insert = "INSERT INTO formulario_etapas (
            Fecha_hora, carrera, apellido_nombre, Fecha_egreso, telefono, correo, ciudad, 
            situacion_laboral, empresa, localidadempresa, cargo, area, mail, 
            relaciontrabajo, vinculacion, Actividad, Docente, Departamento_docente, 
            becario, no_docente, desocupado, capacitarse, acompanar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);

        // Leer cada línea del archivo CSV
        while (($data = fgetcsv($handle)) !== FALSE) {
            // Obtener el nombre del registro actual
            $nombre = $data[2]; // Asumiendo que el nombre está en la tercera columna (índice 2)

            // Eliminar registros antiguos con el mismo nombre
            $stmt_delete->bind_param("s", $nombre);
            $stmt_delete->execute();

            // Insertar nuevo registro
            $stmt_insert->bind_param(
                'sssssssssssssssssssssss',
                $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], 
                $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], 
                $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], 
                $data[19], $data[20], $data[21], $data[22]
            );
            $stmt_insert->execute();
        }

        // Finalizar la transacción
        $conn->commit();

        // Cerrar el archivo
        fclose($handle);

        echo "Archivo CSV importado exitosamente.";
    } else {
        echo "Error al abrir el archivo CSV.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Importar CSV</title>
</head>
<body>
    <h1>Importar CSV a la Base de Datos</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="csv_file">Seleccionar archivo CSV:</label>
        <input type="file" name="csv_file" id="csv_file" required>
        <input type="submit" name="upload" value="Subir CSV">
    </form>
</body>
</html>
