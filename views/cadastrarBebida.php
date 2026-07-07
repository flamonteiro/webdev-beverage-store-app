<?php
    require_once "includes/cabecalho.inc.php";
    $fabricantes = $_SESSION['fabricantes'];    
?>
<p>
<h1 class="text-center">Inclusão de Bebida</h1>
<p> 
  
<form class="row g-3" action="../controlers/controlerProduto.php" method="post">
  <div class="col-md-6">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome" required>
  </div>

  <div class="col-md-3">
    <label for="pVolume" class="form-label">Volume</label>
    <input type="text" class="form-control" name="pVolume" placeholder="Ex: 350ml" required>
  </div>

  <div class="col-md-3">
    <label for="pPreco" class="form-label">Preço</label>
    <input type="text" class="form-control" name="pPreco" required>
  </div>

  <div class="col-md-4">
    <label for="pPeso" class="form-label">Peso (kg)</label>
    <input type="text" class="form-control" name="pPeso" required>
  </div>

  <div class="col-md-4">
    <label for="pFabricante" class="form-label">Fabricante</label>
    <input type="text" class="form-control" name="pFabricante" required>
  </div>

  <div class="col-md-4">
    <label for="pQdeEstoque" class="form-label">Qde Estoque</label>
    <input type="text" class="form-control" name="pQdeEstoque" required>
  </div>

  <div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
  </div>
  
  <!-- ALTERAR VALUE CONFORME O CONTROLLER -->
  <input type="hidden" name="opcao" value="1">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>
