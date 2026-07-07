<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
    <img src="imagens/logo2.png">&nbsp;&nbsp;
    <h4>Distribuidora de Bebidas</h4>
  </a>

  <!-- MENU DO CLIENTE -->
  <!-- OBS: VINCULAR COM OUTRAS PAGINAS -->

  <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">


    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Bebidas
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                      <li><a class="dropdown-item" href="#">Consultar</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Show Room</a></li>
                    </ul>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Cidades
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Cadastrar</a></li>                      
                      <li><a class="dropdown-item" href="#">Consultar</a></li>
                    </ul>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Vendas
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Histórico de Vendas</a></li>                      

                    </ul>
                  </li>
                  <li><a href="#" class="nav-link px-2 link-dark">Dashboard</a></li>

                  <li>
                    <a href="#" class="nav-link px-2 link-dark">Carrinho</a></li>
                  </li>
                </ul>

                <div class="col-md-3 text-end">
                  <button type="button" class="btn btn-outline-primary me-2">Login</button>
                  <button type="button" class="btn btn-primary">Sair</button>
                </div>
  </ul>

  <div class="col-md-3 text-end">
    <?php
      if(!isset($_SESSION['cliente'])){
    ?>              
      <a class="btn btn-outline-primary me-2" role="button" href="formLogin.php">Login</a>                  
    <?php
      } else{
        include_once 'modal.inc.php';
      }
    ?>
  </div>
</header>