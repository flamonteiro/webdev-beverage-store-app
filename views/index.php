<?php require_once "includes/cabecalho.inc.php" ?>

<!-- CONTEUDO -->
<?php if (isset($_GET['acessoNegado'])) { ?>
  <div class="alert alert-danger text-center mt-3" role="alert">
    Acesso restrito ao administrador do sistema.
  </div>
<?php } ?>

<h1 class="text-center">Bem-vindos à nossa distribuidora!</h1>

<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto fs-5" align="justify">
        <img src="imagens/beverageheader.jpg" alt="" class="img-fluid"><br><br>
        <p>Que tal garantir as bebidas para o seu estabelecimento sem sair do lugar? Então confira a nossa loja virtual, feita para atender outras empresas. <strong>As mesmas marcas, variedade e qualidade que sua empresa precisa!</strong></p>
        <p>Nossa Distribuidora oferece uma experiência única para o seu negócio! Aqui você faz suas compras 100% online e escolhe como prefere pagar: via boleto bancário ou cartão de crédito. Simples, rápido e feito sob medida para empresas como a sua!</p>
        <p>Confira nosso estoque de <strong>cervejas, destilados, refrigerantes e muito mais</strong>, e faça suas compras com a praticidade que o seu negócio merece!</p>
      </div> 
    </div>
  </div>
</section>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>