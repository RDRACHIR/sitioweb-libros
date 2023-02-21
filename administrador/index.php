<?php 
session_start();
if($_POST){
  if(($_POST['usuario']=="Dev") && ($_POST['contrasena']=="sistema")){
    $_SESSION['usuario']='ok';
    $_SESSION['nombreUsuario']="Dev";
    header("Location: inicio.php");
  }else {
    $mensaje = "Error: El usurio o contraseña son incorrectos";
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<br>
  <div class="container">
    <div class="row">
      <div class="col-md-4      ">
        
      </div>
      <div class="col-md-4">
        <br><br><br><br>
        <div class="card">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">

          <?php if(isset($mensaje)){ ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $mensaje; ?>
          </div>
          <?php }?>
            <form method="POST">
            <div class = "form-group">
            <label for="usuario">Usuario: </label>
            <input type="text" class="form-control" name="usuario"  placeholder="Escribe tu usuario">
            </div>

            <div class="form-group">
            <label for="contrasena">Contraseña: </label>
            <input type="password" class="form-control" name="contrasena" placeholder="Escribe tu contraseña">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Entrar al sistema</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>