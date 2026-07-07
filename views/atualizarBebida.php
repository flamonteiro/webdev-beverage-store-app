
<?php
    require_once '../classes/bebida.inc.php';
    require_once 'includes/cabecalho.inc.php';

    $bebida = $_SESSION['bebida'];
    $fabricantes = $_SESSION['fabricantes']; 
?>

<p>
<h1 class="text-center">Alteração de Bebida</h1>
<p> 

<form class="row g-3" action="../controllers/inserircontroller" method="post">

  <div class="col-md-2">
    <label for="pIdBebida" class="form-label">ID</label>
    <input type="text" class="form-control" name="pIdBebida" value="<?= $produto->getIdBebida() ?>" readonly>
  </div>  

  <div class="col-md-7">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome" value="<?= $produto->getNome() ?>">
  </div>

  <div class="col-md-3">
    <label for="pVolume" class="form-label">Volume</label>
    <input type="text" class="form-control" name="pVolume" value="<?= $produto->getVolume() ?>" placeholder="Ex: 350ml">
  </div>

  <div class="col-md-3">
    <label for="pPreco" class="form-label">Preço</label>
    <input type="text" class="form-control" name="pPreco" value="<?= $produto->getPreco() ?>">
  </div>

  <div class="col-md-3">
    <label for="pPeso" class="form-label">Peso (kg)</label>
    <input type="text" class="form-control" name="pPeso" value="<?= $produto->getPeso() ?>">
  </div>

  <div class="col-md-3">
    <label for="pFabricante" class="form-label">Fabricante</label>
    <input type="text" class="form-control" name="pFabricante" value="<?= $produto->getFabricante() ?>">
  </div>

  <div class="col-md-3">
    <label for="pQdeEstoque" class="form-label">Qde Estoque</label>
    <input type="text" class="form-control" name="pQdeEstoque" value="<?= $produto->getQdeEstoque() ?>">
  </div>

  <div class="col-12 text-center mt-4">
    <button type="submit" class="btn btn-success">Alterar</button>
  </div>

  <!-- ALTERAR VALUE CONFORME O CONTROLLER -->
  <input type="hidden" name="opcao" value="5">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>