<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $url = "http://".$_SERVER['HTTP_HOST']."/sitioweb"; ?>
  <title>Sitio Web</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <ul class="nav navbar-nav">
          <li class="nav-item">
              <a class="nav-link" href="#" aria-current="page">Develoteca</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="productos.php">Libros</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="nosotros.php">Nosotros</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url."../administrador/index.php" ?>">Login</a>
          </li>
      </ul>
  </nav>

  <div class="container">
    <br>
      <div class="row">