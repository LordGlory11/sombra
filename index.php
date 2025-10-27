<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>CRUD_IvanJimenez</title>
    <?php
      require 'bd.php';
    ?>
</head>
<body >
  
    <table class="table" >
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Edad</th>
      <th scope="col">Grado</th>
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron alumnos</td></tr>"; 
                }
            ?>
  </tbody>
</table>
</body>
</html>