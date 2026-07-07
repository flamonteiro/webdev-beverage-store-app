
<?php
  include_once '../models/bebida.inc.php';
  include_once 'includes/cabecalho.inc.php';
  $bebidas = $_SESSION['bebidas'];
?>
<h1 class="text-center">Show room de bebidas</h1>
<p>

<div class="row row-cols-1 row-cols-md-5 g-4">

<?php
  foreach($bebidas as $bebida){
?>

<div class="col">
    <div class="card">
      <img src="imagens/<?= $bebida->getImagem() ?>" class="card-img-top" alt="<?= $bebida->getNome() ?>" onerror="this.src='imagens/drinklogo.jpg'">
      <div class="card-body">
        <h5 class="card-title"><?= $bebida->getNome() ?></h5>
        <p class="card-text"><?= $bebida->getVolume() ?></p>
        <h6 class="card-text text-end"><?= $bebida->getFabricante() ?></h6>
        <h4 class="card-title">R$<?= number_format($bebida->getPreco(), 2, ',', '.') ?></h4>
        <div class="text-end"><?php echo "<a href='../controllers/CarrinhoController.php?opcao=1&id=".$bebida->getId_bebida()."' class='btn btn-danger'>Comprar</a>" ?></div>
      </div>
    </div>
</div>

<?php
  }
?>
</div>

<?php require_once "includes/rodape.inc.php" ?>