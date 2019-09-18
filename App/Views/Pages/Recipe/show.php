<h1 class="text-primary text-center"><?php echo $recipe[0]->title ?></h1>
<p class="lead text-muted mb-5 text-center"><?php echo $recipe[0]->description ?></p>

<div class="mb-5">
  <div class="p-2 text-center">
    <h4 class="text-secondary m-1">Ingredientes</h4>
    <hr>
  </div>

  <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
    <?php foreach($recipe as $recp):  ?>
      <div class="jumbotron p-3 mr-5 text-center" style="width: 250px;">
          <strong class="lead text-info text-underline d-inline-block mt-2 p-0">
          <u>
            <?php echo $recp->integrant_title  ?>
          </u>
        </strong>
        <span class="text-secondary d-block p-3" style="white-space: pre-line;"><?php echo $recp->integrant_ingredients ?>
        </span>
      </div>
    <?php endforeach ?>
    </div>  
</div>


<div class="mt-5">
  <div class="p-2 text-center">
    <h4 class="text-secondary m-1">Modo de Preparo</h4>
    <hr>
  </div>

  <div class="d-flex align-items-center flex-wrap justify-content-center justify-content-sm-start">

    <?php foreach($recipe as $recp): ?>
      <div class="jumbotron p-3 text-left" style="width: 100%">
          <strong class="lead text-info text-underline d-inline-block m-3 p-0">
          <u>
            <?php echo $recp->integrant_title ?>
          </u>
          </strong>
        <span class="text-secondary d-block p-3 text-left" style="white-space: pre-line;"><?php echo $recp->integrant_direction ?>
        </span>
      </div>
    <?php endforeach ?>
    </div>
  </div>  
</div>

<div class="container my-4 d-flex justify-content-between align-items-center flex-column flex-sm-row">
  <a href="/pratonosso/minhas-receitas" class="my-2">Voltar para as minhas receitas</a>
  <div class="d-flex justify-content-center justify-content-sm-start">
    <a href="/pratonosso/receitas/editar/<?php echo $recipe[0]->id?>" class="btn btn-info">Editar</a>
    <a href="/pratonosso/receitas/excluir/<?php echo $recipe[0]->id?>" class="btn btn-danger ml-2">Deletar</a>
  </div>
</div>
