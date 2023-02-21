<?php include("../template/header.php");?>
<?php
include("../config/db.php");

// Mostrar los registros
$sentencia = $conexion->prepare("SELECT * FROM libros");
$sentencia->execute();
$lista_libros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Recepcionar los datos
$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
  case "Agregar":
    $sentencia = $conexion->prepare("INSERT INTO libros (nombre, imagen) VALUES (:nombre, :imagen);");
    $sentencia->bindParam(":nombre", $txtNombre);

    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

    $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

    if ($tmpImagen!="") {
      move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
    }
    
    $sentencia->bindParam(":imagen", $nombreArchivo);
    $sentencia->execute(); 
    header("Location: $url./administrador/secciones/productos.php");
    break;
  case "Editar":
    $sentenciaS= $conexion->prepare("UPDATE `libros` SET nombre=:nombre WHERE id=:id");
    $sentencia->bindParam(':nombre', $txtNombre);
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();

    if($txtImagen!=""){
    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
    $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

    move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

    $sentencia = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $libro = $sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($libro["imagen"]) && $libro["imagen"]!="imagen.jpg") {
      if(file_exists("../../img/".$libro["imagen"])){
        unlink("../../img/".$libro["imagen"]);
      }
    }

    $sentencia = $conexion->prepare("UPDATE  libros SET imagen=:imagen WHERE `libros`.id=:id");
    $sentencia->bindParam(":imagen", $nombreArchivo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    }
    header("Location: $url./administrador/secciones/productos.php");
    break;
  case "Cancelar":
    header("Location: $url./administrador/secciones/productos.php");
    break;
  case "Seleccionar":
    $sentencia = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $libro = $sentencia->fetch(PDO::FETCH_LAZY);

    $txtNombre = $libro['nombre'];
    $txtImagen = $libro['imagen'];
    break;
  case "Borrar":
    $sentencia = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $libro = $sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($libro["imagen"]) && $libro["imagen"]!="imagen.jpg") {
      if(file_exists("../../img/".$libro["imagen"])){
        unlink("../../img/".$libro["imagen"]);
      }
    } 
    
    $sentencia = $conexion->prepare("DELETE FROM libros WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location: $url./administrador/secciones/productos.php");
    break;
}
?>

<div class="col-md-5">
  <div class="card">
    <div class="card-header">
      Datos de Libro
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">

        <div class = "form-group">
        <label for="txtNombre">Nombre:</label>
        <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Nombre del libro">
        </div>

        <div class = "form-group">
        <label for="txtImagen">Imagen:</label>
        <br>
        <?php if($txtImagen!=""){?>
          <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen?>" width="50" alt="">
        <?php }?>
        <input type="file" class="form-control" name="txtImagen" id="txtImagen"  placeholder="Nombre">
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Button group name">
          <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
          <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Editar" class="btn btn-warning">Editar</button>
          <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-7">
  <br>
<div class="table-responsive">
  <table class="table table-primary table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($lista_libros as $registro){ ?>
      <tr class="">
        <td><?php echo $registro['id']?></td>
        <td><?php echo $registro['nombre']?></td>
        <td>
          <img  class="img-thumbnail rounded" src="../../img/<?php echo $registro['imagen']?>" width="50" alt="">
        </td>
        <td>
          <form method="post">

            <input type="hidden" name="txtID" id="txtID" value="<?php echo $registro['id']?>">
            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

          </form>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>

</div>

<?php include("../template/footer.php");?>