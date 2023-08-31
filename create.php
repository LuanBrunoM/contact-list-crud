<?php
include_once("./templates/header.php");
?>
<div class="container">
  <div class="title">
    <i class="far fa-edit edit-icon"></i>
    <h1 id="main-title-create">Criar Contato</h1>
  </div>
  <form action="<?= $BASE_URL ?>./config/process.php" method="POST">
    <input type="hidden" name="type" value="create">
    <div class="form-group">
      <label for="name">Nome do contato</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required>
    </div>
    <div class="form-group">
      <label for="phone">Telefone de contato</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required>
    </div>
    <div class="form-group">
      <label for="email">Email de contato</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Digite o email" required>
    </div>
    <div class="form-group">
      <label for="observations">Observações</label>
      <textarea type="text" rows="5" class="form-control" id="observations" name="observations" placeholder="Digite as observações"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</div>
<?php
include_once("./templates/footer.php");
?>