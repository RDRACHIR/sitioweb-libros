<?php 
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location:../index.php");
}else {
  if($_SESSION['usuario']=="ok"){
    $nombreUsuario=$_SESSION["nombreUsuario"];
  }
}
?>
<!doctype html>
<html lang="en">

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
  <!-- Redireccion  -->
<?php $url = "http://".$_SERVER['HTTP_HOST']."/sitioweb"; ?>


<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="#" aria-current="page">Administrador del sitio web</a>
        <a class="nav-item nav-link" href="<?php echo $url."/administrador/inicio.php" ?>">Inicio</a>

        <a class="nav-item nav-link" href="<?php echo $url."/administrador/secciones/productos.php"?>">Libros</a>
        <a class="nav-item nav-link" href="<?php echo $url."/administrador/secciones/cerrar.php"?>">Cerrar</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
    </div>
</nav>
<div class="container">
  <br>
  <div class="row">