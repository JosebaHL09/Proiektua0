<?php require "../Templates/header.php"; ?>
<?php

//include 'funciones.php';

$config = include '../Model/config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

try {
    if($_SESSION['ikasleid']){
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
            
        $id = $_GET['id'];
        
        $consultaSQL = "UPDATE alumnos set id_curso = ". $id ." WHERE id =" .$_SESSION['ikasleid'];


        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        header("Location:index.php");
    }else{
        header("Location:index.php");
    }
} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>



<div class="container mt-2">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
</div>

<?php require "../Templates/footer.php"; ?>