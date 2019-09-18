<div class="mx-auto d-flex flex-wrap justify-content-center justify-content-sm-start" style="max-width: 1000px;">

  <?php if (count($recipes) === 0): ?>
    <div class="jumbotron text-center">
      <h2 class="mb-4">Você não tem nenhuma receita publicada</h2>
      <a href="/pratonosso/receitas/criar" class="btn btn-primary">Publicar receita</a>
    </div>

  <?php endif ?>

  <?php foreach($recipes as $recipe): ?>
    <div class="card m-3" style="width: 300px; height: 200px">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $recipe->title?></h5>
          <p class="card-text text-muted">
          <?php 
            if (isset($recipe->description)) {
              echo $recipe->description;
            } else {
              echo '<i>Descrição não informada</i>';
            }
          ?>
          </p>
          <a href="/pratonosso/minhas-receitas/<?php echo $recipe->id?>" class="btn btn-primary btn-block mt-auto">Ver receita</a>
        </div>
      </div>
  <?php endforeach ?>
</div>
