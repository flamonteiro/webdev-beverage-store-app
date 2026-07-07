<?php
    require_once "includes/cabecalho.inc.php";   
?>
<p>
<h1 class="text-center">Cadastro de Cidade</h1>
<p> 
  
<form class="row g-3" action="../controllers/CidadeController.php" method="post">
  
  <div class="col-md-6">
    <label for="cCidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" name="cCidade" required maxLength="30">
  </div>

  <div class="col-md-2">
    <label for="cEstado" class="form-label">Estado (UF)</label>
    <input type="text" class="form-control" name="cEstado" placeholder="Ex: SP" required maxLength="2">
  </div>

  <div class="col-md-4">
    <label for="cCEP" class="form-label">CEP</label>
    <input type="text" class="form-control" name="cCEP" placeholder="00000-000" required maxLength="9">
  </div>

  <div class="col-md-6">
    <label for="cValorFrete" class="form-label">Valor do Frete</label>
    <input type="text" class="form-control" name="cValorFrete" required>
  </div>


  <div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
  </div>
  
  <input type="hidden" name="opcao" value="1">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>
