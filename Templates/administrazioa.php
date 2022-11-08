<?php
include '../Model/funciones.php';

$error = false;
$config = include '../Model/config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);



  if (isset($_POST['apellido']) && $_POST['apellido'] != "") {  
    $consultaSQL = "SELECT * FROM alumnos WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
  } else if (isset($_POST['Group'])) {
    $consultaSQL = "SELECT * FROM alumnos WHERE id_curso LIKE '%" . $_POST['Group'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM alumnos";
  }


  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

  $consultaSQL1 = "SELECT * FROM cursos";

   $sentencia1 = $conexion->prepare($consultaSQL1);
   $sentencia1->execute();

   $cursos = $sentencia1->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['apellido']) && $_POST['apellido'] != "" ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';
?>

<?php include "../templates/header.php"; 
if($_SESSION['admin'] != 1){
  header("Location:index.php");
}
?>


<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>



<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form method="post" class="form-inline buscador">
        <div class="form-group mr-3">
          <input type="text" id="apellido" name="apellido" placeholder="Buscar por apellido" class="form-control">
        </div>
        <input name="submit" type="submit" class="btnB" value="Ver resultados">
      </form>
          </div>
      <div class="col-md-6">
      <form method="post" class="form-inline buscador">
        <div class="form-group mr-3">
        <label for="animalGroup">Seleciona el cursoㅤ</label>
                                      <select name="Group" id="Group">
            <?php
            foreach($cursos as $m)
            {
            ?>
                <option value="<?php echo $m['Id'];?>"><?php echo $m['Abreviatura'];?></option>
            <?php
            }
        ?>
        </select>
        </div>
        <input name="submit" type="submit" class="btnB" value="Ver resultados">
      </form>
          </div>
    </div>
  </div>
</div>



<div class="container">
  <h2 class="mt-3 tit"><?= $titulo ?></h2>
  <h4><a class="mt-3 tit"href="crear.php">Crear un alumno</a></h4> 
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
            if ($alumnos && $sentencia->rowCount() > 0) {
              foreach ($alumnos as $fila) {
                ?>
                <tr>
                  <td data-label="#"><?php echo escapar($fila["id"]); ?></td>
                  <td data-label="Nombre"><?php echo escapar($fila["nombre"]); ?></td>
                  <td data-label="Apellido"><?php echo escapar($fila["apellido"]); ?></td>
                  <td data-label="Email"><?php echo escapar($fila["email"]); ?></td>
                  <td data-label="Edad"><?php echo escapar($fila["edad"]); ?></td>
                  <td data-label="Acciones">
                    <a href="<?= 'borrar.php?id=' . escapar($fila["id"]) ?>">🗑️Borrar</a>
                    <a href="<?= 'editar.php?id=' . escapar($fila["id"]) ?>" . >✏️Editar</a>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
    </tbody>
  </table>
</div>



<?php include "../templates/footer.php"; ?>

