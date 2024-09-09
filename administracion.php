<?php
// Datos de conexión
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

// Inicializar variables para ordenar
$order_by = isset($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'id';
$order_dir = isset($_GET['order_dir']) ? $conn->real_escape_string($_GET['order_dir']) : 'ASC';

// Preparar la consulta
$sql = "SELECT * FROM formulario_etapas";
if (isset($_GET['filter_column']) && isset($_GET['filter_value'])) {
    $filter_column = $conn->real_escape_string($_GET['filter_column']);
    $filter_value = $conn->real_escape_string($_GET['filter_value']);
    $sql .= " WHERE $filter_column LIKE '%$filter_value%'";
}
$sql .= " ORDER BY $order_by $order_dir";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Administración</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function showModal(userId) {
            var modal = document.getElementById("userModal");
            var modalContent = document.getElementById("modalContent");
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_user_data.php?id=" + userId, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    modalContent.innerHTML = xhr.responseText;
                    modal.style.display = "block";
                }
            };
            xhr.send();
        }

        function closeModal() {
            var modal = document.getElementById("userModal");
            modal.style.display = "none";
        }

        function resetFilters() {
            // Restablecer el formulario de filtros
            document.getElementById("filterForm").reset();
            // Redirigir a la misma página sin parámetros de filtro
            window.location.href = window.location.pathname;
        }
        
    </script>
</head>

<body>
    <h1>Interfaz de Administración</h1>

    <form method="get" action="" id="filterForm">
        <label for="filter_column">Filtrar por:</label>
        <select name="filter_column" id="filter_column">
            <option value="carrera">Carrera</option>
            <option value="apellido_nombre">Apellido y Nombre</option>
            <option value="Fecha_egreso">Fecha de Egreso</option>
            <option value="telefono">Teléfono</option>
            <option value="correo">Correo</option>
            <option value="ciudad">Ciudad</option>
            <option value="situacion_laboral">Situación Laboral</option>
            <option value="empresa">Empresa</option>
            <option value="localidadempresa">Localidad Empresa</option>
            <option value="cargo">Cargo</option>
            <option value="area">Área</option>
            <option value="mail">Mail</option>
            <option value="relaciontrabajo">Relación Trabajo</option>
            <option value="vinculacion">Vinculación</option>
            <option value="Actividad">Actividad</option>
            <option value="Docente">Docente</option>
            <option value="Departamento_docente">Departamento Docente</option>
            <option value="becario">Becario</option>
            <option value="no_docente">No Docente</option>
            <option value="desocupado">Desocupado</option>
            <option value="capacitarse">Capacitarse</option>
            <option value="acompanar">Acompañar</option>
            <option value="carrera" <?php if (isset($_GET['filter_column']) && $_GET['filter_column'] === 'carrera') echo 'selected'; ?>>Carrera</option>
            <option value="apellido_nombre" <?php if (isset($_GET['filter_column']) && $_GET['filter_column'] === 'apellido_nombre') echo 'selected'; ?>>Apellido y Nombre</option>
            <!-- Agrega otras opciones según sea necesario -->
        </select>
        <input type="text" name="filter_value" placeholder="Valor a filtrar" value="<?php echo isset($_GET['filter_value']) ? htmlspecialchars($_GET['filter_value']) : ''; ?>">
        
        <label for="order_by">Ordenar por:</label>
        <select name="order_by" id="order_by">
            <option value="id" <?php echo ($order_by === 'id') ? 'selected' : ''; ?>>ID</option>
            <option value="Fecha_hora" <?php echo ($order_by === 'Fecha_hora') ? 'selected' : ''; ?>>Fecha y Hora</option>
            <option value="Fecha_egreso" <?php echo ($order_by === 'Fecha_egreso') ? 'selected' : ''; ?>>Fecha de Egreso</option>
            <!-- Agrega otras opciones según sea necesario -->
        </select>
        <label for="order_dir">Dirección:</label>
        <select name="order_dir" id="order_dir">
            <option value="ASC" <?php echo ($order_dir === 'ASC') ? 'selected' : ''; ?>>Ascendente</option>
            <option value="DESC" <?php echo ($order_dir === 'DESC') ? 'selected' : ''; ?>>Descendente</option>
        </select>
        <input type="submit" value="Aplicar">
        <input type="button" value="Quitar Filtros" onclick="resetFilters()">
    </form>



    <!-- Tabla de datos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Acciones</th>
                <th>Fecha y Hora</th>
                <th>Carrera</th>
                <th>Apellido y Nombre</th>
                <th>Fecha de Egreso</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Ciudad</th>
                <th>Situación Laboral</th>
                <th>Empresa</th>
                <th>Localidad Empresa</th>
                <th>Cargo</th>
                <th>Área</th>
                <th>Mail</th>
                <th>Relación Trabajo</th>
                <th>Vinculación</th>
                <th>Actividad</th>
                <th>Docente</th>
                <th>Departamento Docente</th>
                <th>Becario</th>
                <th>No Docente</th>
                <th>Desocupado</th>
                <th>Capacitarse</th>
                <th>Acompañar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="<?php echo htmlspecialchars($row['id']); ?>" style="background-color: <?php echo htmlspecialchars($row['color']); ?>;">
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td>
                    <button onclick="showModal(<?php echo $row['id']; ?>)">Ver</button>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                </td>
                <td><?php echo htmlspecialchars($row['Fecha_hora']); ?></td>
                <td><?php echo htmlspecialchars($row['carrera']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido_nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['Fecha_egreso']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                <td><?php echo htmlspecialchars($row['ciudad']); ?></td>
                <td><?php echo htmlspecialchars($row['situacion_laboral']); ?></td>
                <td><?php echo htmlspecialchars($row['empresa']); ?></td>
                <td><?php echo htmlspecialchars($row['localidadempresa']); ?></td>
                <td><?php echo htmlspecialchars($row['cargo']); ?></td>
                <td><?php echo htmlspecialchars($row['area']); ?></td>
                <td><?php echo htmlspecialchars($row['mail']); ?></td>
                <td><?php echo htmlspecialchars($row['relaciontrabajo']); ?></td>
                <td><?php echo htmlspecialchars($row['vinculacion']); ?></td>
                <td><?php echo htmlspecialchars($row['Actividad']); ?></td>
                <td><?php echo htmlspecialchars($row['Docente']); ?></td>
                <td><?php echo htmlspecialchars($row['Departamento_docente']); ?></td>
                <td><?php echo htmlspecialchars($row['becario']); ?></td>
                <td><?php echo htmlspecialchars($row['no_docente']); ?></td>
                <td><?php echo htmlspecialchars($row['desocupado']); ?></td>
                <td><?php echo htmlspecialchars($row['capacitarse']); ?></td>
                <td><?php echo htmlspecialchars($row['acompanar']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>
</body>
</html>
