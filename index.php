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
                        echo "<button class='btn btn-outline-primary'>Editar</button> ";
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

<button type="button" class="btn btn-outline-success">Agregar</button>

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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
  $('#confirmDeleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // botón que abrió el modal
    var idAlumno = button.data('id'); // obtiene el id del alumno
    $('#idAlumnoEliminar').val(idAlumno); // pasa el id al input hidden
  });
</script>

</body>
</html>