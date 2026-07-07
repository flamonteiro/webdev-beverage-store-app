<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start py-3 mb-4 border-bottom">
  <a href="index.php" class="d-flex align-items-center flex-shrink-0 mb-2 mb-md-0 text-dark text-decoration-none brand-lockup">
    <img src="imagens/drinklogo.jpg" class="brand-logo">
    <span class="brand-name">Alegre<span class="brand-name-sub">Distribuidora</span></span>
  </a>

  <ul class="nav site-nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

    <li><a href="index.php" class="nav-link px-2 link-dark">Home</a></li>

    <li><a href="../controllers/BebidaController.php?opcao=6" class="nav-link px-2 link-dark">Nossas Bebidas</a></li>

    <li><a href="meusDados.php" class="nav-link px-2 link-dark">Seus dados</a></li>

    <li><a href="contato.php" class="nav-link px-2 link-dark">Contato</a></li>

    <li><a href="exibirCarrinho.php" class="nav-link px-2 link-dark">Carrinho</a></li>

  </ul>

  <div class="ms-md-auto flex-shrink-0 text-end">
    <?php
      if (!isset($_SESSION['cliente'])) {
    ?>
      <a class="btn btn-outline-primary me-2" role="button" href="formLogin.php">Login</a>
    <?php
      } else {
        include_once "modal.inc.php";
      }
    ?>
  </div>
</header>
