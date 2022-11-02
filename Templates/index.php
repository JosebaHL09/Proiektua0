<?php
include '../Model/funciones.php';

$error = false;
$config = include '../Model/config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  $consultaSQL = "SELECT * FROM cursos";
  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $cursos = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

?>
<!DOCTYPE html>
<html>
<?php include "header.php"; ?>
<div class="container index">   
<h2 class="mt-3 tit">Lista de cursos</h2>       
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Abreviatura</th>
        <th>Nombre</th>
        <th>Tutor</th>
        <th>Horas</th>
      </tr>
    </thead>
    <tbody>
    <?php
            if ($cursos && $sentencia->rowCount() > 0) {
              foreach ($cursos as $fila) {
                ?>
                <tr>
                  <td data-label="#"><?php echo escapar($fila["Id"]); ?></td>
                  <td data-label="Abreviatura"><?php echo escapar($fila["Abreviatura"]); ?></td>
                  <td data-label="Nombre"><?php echo escapar($fila["Nombre"]); ?></td>
                  <td data-label="Tutor"><?php echo escapar($fila["Tutor"]); ?></td>
                  <td data-label="Horas"><?php echo escapar($fila["Horas"]); ?></td>
                </tr>
                <?php
              }
            }
            ?>
    </tbody>
  </table>
</div>
<?php include "footer.php"; ?>
</html>