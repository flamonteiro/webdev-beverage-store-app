<?php
      $metodo = $_GET['metodo'] ?? 'cartao';
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distribuidora de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img src="../imagens/drinklogo.jpg" style="height: 50px; width: auto;">&nbsp;&nbsp;
          <h4>Distribuidora de Bebidas</h4>
        </a>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../index.php" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="../showroomBebidas.php" class="nav-link px-2 link-secondary">Nossas Bebidas</a></li>
          <li><a href="../exibirCarrinho.php" class="nav-link px-2 link-dark">Carrinho</a></li>
        </ul>
      </header>

      <div class="text-center my-5">
        <h1 class="text-success mb-4">Pedido realizado com sucesso!</h1>
        <p class="fs-5">
          Forma de pagamento escolhida: <strong><?= $metodo === 'boleto' ? 'Boleto Bancário' : 'Cartão de Crédito' ?></strong>
        </p>
        <a href="../showroomBebidas.php" class="btn btn-primary mt-3">Voltar para a loja</a>
      </div>

      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <span class="text-body-secondary">&copy; 2026 - UFES, Alegre ES</span>
      </footer>
    </div>
  </body>
</html>
