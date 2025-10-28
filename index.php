<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>CRUD_IvanJimenez</title>
    <?php
      require 'bd.php';

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_eliminar'])) {
      $id = $_POST['id_eliminar'];
      $query = "DELETE FROM Alumnos WHERE id_alumno = $1";
      eliminar($query, [$id]);
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
          $nombre = $_POST['nombre'];
          $edad = $_POST['edad'];
          $grado = $_POST['grado'];

          $query = "INSERT INTO Alumnos (nombre, edad, grado) VALUES ($1, $2, $3)";
          insertar($query, [$nombre, $edad, $grado]);
      }




      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
      $id = $_POST['id_modificar'];
      $nombre = $_POST['nombre'];
      $edad = $_POST['edad'];
      $grado = $_POST['grado'];

      $query = "UPDATE Alumnos SET nombre = $1, edad = $2, grado = $3 WHERE id_alumno = $4";
      modificar($query, [$nombre, $edad, $grado, $id]);
      }


    ?>
</head>
<body >
  
    <table class="table" >
  
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Edad</th>
      <th scope="col">Grado</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
                
                $query = "SELECT id_alumno, nombre, edad, grado FROM Alumnos"; 
                $resultados = seleccionar($query, []);

                
                if ($resultados) {
                    
                    foreach ($resultados as $index => $alumno) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>"; 
                        echo "<td>" . htmlspecialchars($alumno['nombre']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($alumno['edad']) . "</td>";
                        echo "<td>" . htmlspecialchars($alumno['grado']) . "</td>";

                        echo "<td>";


                       echo "<button class='btn btn-outline-primary' data-toggle='modal' data-target='#editarModal' data-id='" . $alumno['id_alumno'] . "'
                        data-nombre='" . htmlspecialchars($alumno['nombre']) . "'
                        data-edad='" . htmlspecialchars($alumno['edad']) . "'
                        data-grado='" . htmlspecialchars($alumno['grado']) . "'>
                        Editar
                      </button> ";


                        echo "<button class='btn btn-outline-danger' data-toggle='modal' data-target='#confirmDeleteModal' data-id='" . $alumno['id_alumno'] . "'>Eliminar</button>";

                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron alumnos</td></tr>"; 
                }
            ?>
  </tbody>
</table>

<div class="text-center mt-3">
  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#agregarModal">
    Agregar
  </button>
</div>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar al alumno?</p>
          <input type="hidden" name="id_eliminar" id="idAlumnoEliminar">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>

  <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action=""> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarModalLabel">Agregar Alumno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="col-7">
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="col">
              <input type="number" class="form-control" name="edad" placeholder="Edad" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" name="grado" placeholder="Grado" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-success" name="guardar">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>




<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarModalLabel">Editar Alumno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id_modificar" id="editId">
          <div class="form-row">
            <div class="col-7">
              <input type="text" class="form-control" name="nombre" id="editNombre" placeholder="Nombre" required>
            </div>
            <div class="col">
              <input type="number" class="form-control" name="edad" id="editEdad" placeholder="Edad" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" name="grado" id="editGrado" placeholder="Grado" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-primary" name="modificar">Guardar Cambios</button>
        </div>
      </div>
    </form>
  </div>
</div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
  $('#confirmDeleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var idAlumno = button.data('id'); 
    $('#idAlumnoEliminar').val(idAlumno); 
  });
</script>

<script>
  $('#editarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nombre = button.data('nombre');
    var edad = button.data('edad');
    var grado = button.data('grado');

    $('#editId').val(id);
    $('#editNombre').val(nombre);
    $('#editEdad').val(edad);
    $('#editGrado').val(grado);
  });
</script>


</body>
</html>