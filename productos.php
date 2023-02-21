<?php include("./template/header.php");?> 
<?php 
include("./administrador/config/db.php");

// Mostrar los registros
$sentencia = $conexion->prepare("SELECT * FROM libros");
$sentencia->execute();
$lista_libros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($lista_libros as $libro){?>
<div class="col-md-3      ">
  <div class="card">
    <img class="card-img-top" src="img/<?php echo $libro['imagen']?>" alt="Libro" width="50">
    <div class="card-body">
      <h4 class="card-title"><?php echo $libro['nombre']?></h4>
      <a name="" id="" class="btn btn-primary" href="https://goalkicker.com/" role="button">Ver más</a>
    </div>
  </div>
</div>
<?php }?>
<?php include("./template/footer.php");?>