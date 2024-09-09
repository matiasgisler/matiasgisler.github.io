<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Etapas</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body>
    <form id="formulario" method="POST" action="procesar_formulario.php">
        <!-- Etapa 1 -->
        <div class="step active" id="step1">
            <h2>Etapa 1</h2>
            <label for="Fecha_hora">Fecha y Hora:</label>
            <input type="datetime-local" id="Fecha_hora" name="Fecha_hora" required><br><br>
            
            <label for="carrera">Carrera:</label>
            <select id="carrera" name="carrera" required>
                <option value="Ingeniería en Agrimensura">Ingeniería en Agrimensura</option>
                <option value="Ingeniería en Construcciones">Ingeniería en Construcciones (no vigente)</option>
                <option value="Ingeniería civil">Ingeniería civil</option>
                <option value="Ingeniería Electromecánica">Ingeniería Electromecánica</option>
                <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                <option value="Ingeniería Química">Ingeniería Química</option>
                <option value="Ingeniería en Seguridad e Higiene en el Trabajo">Ingeniería en Seguridad e Higiene en el Trabajo</option>
                <option value="Licenciatura en Tecnología de los Alimentos">Licenciatura en Tecnología de los Alimentos</option>
                <option value="Profesorado en Química">Profesorado en Química</option>
                <option value="Técnico Universitario en Electromedicina">Técnico Universitario en Electromedicina</option>
                <option value="Licenciatura en Tecnología Médica">Licenciatura en Tecnología Médica</option>
                <option value="Licenciatura en Enseñanza de las Ciencias Naturales">Licenciatura en Enseñanza de las Ciencias Naturales</option>
                <option value="Maestría en Enseñanza de las Ciencias Experimentales">Maestría en Enseñanza de las Ciencias Experimentales</option>
                <option value="Maestría en Tecnología del Hormigón">Maestría en Tecnología del Hormigón</option>
            </select><br><br>
            
            <label for="apellido_nombre">Apellido y nombre:</label>
            <input type="text" id="apellido_nombre" name="apellido_nombre" required><br><br>
            
            <label for="fecha_egreso">Fecha de Egreso:</label>
            <input type="date" id="fecha_egreso" name="fecha_egreso" required><br><br>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br><br>
            
            <label for="correo">Correo:</label>
            <input type="text" id="correo" name="correo" required><br><br>
            
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required><br><br>
            
            <label for="situacion_laboral">Situación Laboral:</label>
            <select id="situacion_laboral" name="situacion_laboral" required>
                <option value="Trabajo por cuenta propia">Trabajo por cuenta propia</option>
                <option value="Trabajo en relación de dependencia">Trabajo en relación de dependencia</option>
                <option value="Desempleado/a">Desempleado/a</option>
                <option value="Jubilado/a">Jubilado/a</option>
            </select><br><br>
            
            <button type="button" onclick="nextStep()">SIGUIENTE</button>
        </div>

        <!-- Etapa 2 -->
        <div class="step" id="step2">
            <h2>Etapa 2</h2>
            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa" required><br><br>
            
            <label for="localidadempresa">Localidad Empresa:</label>
            <input type="text" id="localidadempresa" name="localidadempresa" required><br><br>
            
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" required><br><br>
            
            <label for="area">Área:</label>
            <input type="text" id="area" name="area" required><br><br>
            
            <label for="mail">Mail:</label>
            <input type="text" id="mail" name="mail" required><br><br>
            
            <label for="relaciontrabajo">Relación Trabajo:</label>
            <input type="text" id="relaciontrabajo" name="relaciontrabajo" required><br><br>
            
            <label for="vinculacion">Vinculación:</label>
            <select id="vinculacion" name="vinculacion" required>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select><br><br>
            
            <label for="Actividad">Actividad:</label>
            <select id="Actividad" name="Actividad" required>
                <option value="APE">Actividades profesionales específicas (APE)</option>
                <option value="APNE">Actividades profesionales no específicas (APNE)</option>
                <option value="AA">Actividad Académica (AA)</option>
                <option value="AG">Actividades gerenciales (AG)</option>
                <option value="OA">Otras actividades (OA)</option>
            </select><br><br>
            
            <button type="button" onclick="prevStep()">ATRÁS</button>
            <button type="button" onclick="nextStep()">SIGUIENTE</button>
        </div>

        <!-- Etapa 3 -->
        <div class="step" id="step3">
            <h2>Etapa 3</h2>
            <label for="Docente">Docente:</label>
            <input type="text" id="Docente" name="Docente" required><br><br>

            <label for="cargo_docente">Si es DOCENTE, indique cuál es el cargo que ocupa en la Universidad:</label>
            <select id="cargo_docente" name="cargo_docente">
                <option value="Profesor Titular">Profesor Titular</option>
                <option value="Profesor Asociado">Profesor Asociado</option>
                <option value="Profesor Adjunto">Profesor Adjunto</option>
                <option value="Jefe de Trabajos Prácticos">Jefe de Trabajos Prácticos</option>
                <option value="Ayudante Diplomado">Ayudante Diplomado</option>
            </select><br><br>
            
            <label for="Departamento_docente">Departamento Docente:</label>
            <input type="text" id="Departamento_docente" name="Departamento_docente" required><br><br>
            
            <label for="becario">Becario:</label>
            <input type="text" id="becario" name="becario" required><br><br>
            
            <label for="no_docente">No Docente:</label>
            <input type="text" id="no_docente" name="no_docente" required><br><br>
            
            <label for="desocupado">Desocupado:</label>
            <input type="text" id="desocupado" name="desocupado" required><br><br>
            
            <label for="capacitarse">Capacitarse:</label>
            <input type="text" id="capacitarse" name="capacitarse" required><br><br>
            
            <label for="acompanar">Acompañar:</label>
            <input type="text" id="acompanar" name="acompanar" required><br><br>
            
            <button type="button" onclick="prevStep()">ATRÁS</button>
            <button type="button" onclick="nextStep()">SIGUIENTE</button>
        </div>

        <!-- Etapa 4 -->
        <div class="step" id="step4">
        <h2>Etapa 4 de 4</h2>
            <label for="tematica">Sobre qué temática le interesaría CAPACITARSE, Indicar cada una, separada con ";":</label>
            <input type="text" id="tematica" name="tematica"><br><br>
            
            <label for="acompanar">DE qué manera la FIO lo/la puede acompañar luego de su graduación. Indicar respuestas, separadas con ";":</label>
            <input type="text" id="acompanar" name="acompanar"><br><br>
            
            <button type="button" onclick="prevStep()">ATRÁS</button>
            <button type="submit">MANDAR FORMULARIO</button>
            <button type="button" onclick="resetForm()">BORRAR FORMULARIO</button>
        </div>


        <!-- Barra de progreso -->
        <div class="progress-bar">
            <span id="progress"></span>
            <label id="progress-label">Etapa 1 de 4</label>
        </div>
    </form>

</body>
</html>
