<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start py-3 mb-4 border-bottom">
  <a href="index.php" class="d-flex align-items-center flex-shrink-0 mb-2 mb-md-0 text-dark text-decoration-none brand-lockup">
    <img src="imagens/drinklogo.jpg" class="brand-logo">
    <span class="brand-name">Alegre<span class="brand-name-sub">Distribuidora</span></span>
  </a>

  <ul class="nav site-nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

    <li><a href="index.php" class="nav-link px-2 link-dark">Home</a></li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Bebidas
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="cadastrarBebida.php">Cadastrar</a></li>
        <li><a class="dropdown-item" href="../controllers/BebidaController.php?opcao=2">Consultar</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../controllers/BebidaController.php?opcao=6">Show Room</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Cidades
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="cadastrarCidade.php">Cadastrar</a></li>
        <li><a class="dropdown-item" href="../controllers/CidadeController.php?opcao=2">Consultar</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Clientes
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="cadastrarCliente.php">Cadastrar</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Vendas
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../controllers/PedidoController.php?opcao=2">Histórico de Vendas</a></li>
      </ul>
    </li>
    <li><a href="exibirDashboard.php" class="nav-link px-2 link-dark">Dashboard</a></li>

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
