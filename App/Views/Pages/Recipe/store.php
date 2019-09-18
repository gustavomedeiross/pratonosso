<h1 class="text-primary text-center">Nova receita</h1>

<form action="/pratonosso/recipes/store" method="POST">

  <?php if (isset($_SESSION['errors'])): ?>
    <?php foreach($_SESSION['errors'] as $err): ?>
      <div class="alert alert-danger">
        <?php echo $err ?>
      </div>
    <?php endforeach ?>
    <?php unset($_SESSION['errors']); ?>
  <?php endif ?>

  <div class="form-group mb-4">
    <label for="" class="lead">Título:</label>
    <input type="text" class="form-control" name="title" placeholder="ex: Bolo de Chocolate, Frango Assado, etc" required>
  </div>
  <div class="form-group mb-4">
    <label for="" class="lead">Descrição:</label>
    <textarea name="description" class="form-control" placeholder="ex: Lasanha feita apenas com ingredientes naturais"></textarea>
  </div>

  <div class="my-5">
    <button type="button" class="btn btn-primary mb-1" id="addIntg">Adicionar novo integrante da receita</button>
    <small class="d-block">Ex: Massa, calda, molho, etc.</small>
  </div>

  <button type="submit" id="submitButton" class="d-none"></button>
</form>

<label for="submitButton" class="btn btn-success mb-5">Publicar</label>



<script>
  const addIntegrantButton = document.querySelector('button#addIntg');

  addIntegrantButton.addEventListener('click', createNewForm);

  function createNewForm() {
    const form = document.querySelector('form');
    const div = document.createElement('div');
    div.innerHTML = `
      <hr class="bg-primary">
      <div class="mb-5 integrants">
        <div class="form-group mb-4">
          <label class="lead">Título:</label>
            <input name="integrant_title[]" type="text" class="form-control" placeholder="ex: Molho, Massa, Calda..." required>
        </div>
        <div class="form-group mb-4">
          <label for="" class="lead">Ingredientes:</label>
          <textarea name="integrant_ingredients[]" class="form-control" placeholder="ex: 3 xícaras de farinha, 2 colheres de sopa de óleo..."></textarea>
        </div>
        <div class="form-group mb-4">
          <label for="" class="lead">Modo de preparo:</label>
            <textarea name="integrant_directions[]" class="form-control" placeholder="ex: Misturar a farinha com o óleo em uma tigela..."></textarea>
        </div>
        <div class="text-right">
          <button type="button" class="btn btn-danger" onclick="removeIntegrant(this)">Remover</button>
        </div>
      </div>
    `;

    form.appendChild(div);
  }

  function removeIntegrant(el) {
    const button = el;
    const div = el.parentElement.parentElement.parentElement;
    div.parentElement.removeChild(div);
  }

</script>