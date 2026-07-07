<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distribuidora de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
      .brand-lockup { gap: 1rem; }
      .brand-logo { height: 50px; width: 50px; object-fit: contain; }
      .brand-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.6rem;
        line-height: 1.15;
        letter-spacing: -0.01em;
        color: #1a1a1a;
        display: flex;
        flex-direction: column;
      }
      .brand-name-sub {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #6c757d;
        margin-top: 0.15rem;
      }
      .site-nav { margin-left: 1.5rem; }
      .site-nav .nav-link {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 0.95rem;
      }
      @media (min-width: 768px) {
        .site-nav { margin-left: 3rem; }
      }
    </style>
  </head>
  <body>
        <div class="container">
<?php
    $tipo = 'C';
    session_start();

    if(isset($_SESSION['cliente'])){
      $tipo = $_SESSION['cliente']->tipo;
    }
    require_once "menu$tipo.inc.php";
?>          