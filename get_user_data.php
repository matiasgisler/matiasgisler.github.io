<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unicen-formulario"; // Asegúrate de usar el nombre correcto de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario desde el parámetro de la URL
$user_id = intval($_GET['id']);

// Consultar los datos del usuario
$sql = "SELECT * FROM formulario_etapas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar los datos del usuario
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Detalles del Usuario</h2>";
    echo "<p><strong>ID:</strong> " . htmlspecialchars($row['id']) . "</p>";
    echo "<p><strong>Fecha y Hora:</strong> " . htmlspecialchars($row['Fecha_hora']) . "</p>";
    echo "<p><strong>Carrera:</strong> " . htmlspecialchars($row['carrera']) . "</p>";
    echo "<p><strong>Apellido y Nombre:</strong> " . htmlspecialchars($row['apellido_nombre']) . "</p>";
    echo "<p><strong>Fecha de Egreso:</strong> " . htmlspecialchars($row['Fecha_egreso']) . "</p>";
    echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($row['telefono']) . "</p>";
    echo "<p><strong>Correo:</strong> " . htmlspecialchars($row['correo']) . "</p>";
    echo "<p><strong>Ciudad:</strong> " . htmlspecialchars($row['ciudad']) . "</p>";
    echo "<p><strong>Situación Laboral:</strong> " . htmlspecialchars($row['situacion_laboral']) . "</p>";
    echo "<p><strong>Empresa:</strong> " . htmlspecialchars($row['empresa']) . "</p>";
    echo "<p><strong>Localidad Empresa:</strong> " . htmlspecialchars($row['localidadempresa']) . "</p>";
    echo "<p><strong>Cargo:</strong> " . htmlspecialchars($row['cargo']) . "</p>";
    echo "<p><strong>Área:</strong> " . htmlspecialchars($row['area']) . "</p>";
    echo "<p><strong>Mail:</strong> " . htmlspecialchars($row['mail']) . "</p>";
    echo "<p><strong>Relación Trabajo:</strong> " . htmlspecialchars($row['relaciontrabajo']) . "</p>";
    echo "<p><strong>Vinculación:</strong> " . htmlspecialchars($row['vinculacion']) . "</p>";
    echo "<p><strong>Actividad:</strong> " . htmlspecialchars($row['Actividad']) . "</p>";
    echo "<p><strong>Docente:</strong> " . htmlspecialchars($row['Docente']) . "</p>";
    echo "<p><strong>Departamento Docente:</strong> " . htmlspecialchars($row['Departamento_docente']) . "</p>";
    echo "<p><strong>Becario:</strong> " . htmlspecialchars($row['becario']) . "</p>";
    echo "<p><strong>No Docente:</strong> " . htmlspecialchars($row['no_docente']) . "</p>";
    echo "<p><strong>Desocupado:</strong> " . htmlspecialchars($row['desocupado']) . "</p>";
    echo "<p><strong>Capacitarse:</strong> " . htmlspecialchars($row['capacitarse']) . "</p>";
    echo "<p><strong>Acompañar:</strong> " . htmlspecialchars($row['acompanar']) . "</p>";
} else {
    echo "No se encontraron datos para el ID proporcionado.";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
