<?php 
  require_once 'App/Models/Recipe.php';
  require_once 'App/Models/Integrant.php';

  class RecipeController extends Controller {
    public function renderIndex() {
      $recipe = new Recipe();

      $recipe->user_id = $_SESSION['user_id'];
      $recipes = $recipe->findAllByUser();
      $this->set('recipes', $recipes);
      $this->render('Pages/Recipe/index');
    }

    public function renderShow($payload) {
      extract($payload);

      $recipe = new Recipe();

      $recipe->id = $id;
      $recipe->user_id = $_SESSION['user_id'];

      $recipe_data = $recipe->findOne();

      $this->set('recipe', $recipe_data);
      $this->render('Pages/Recipe/show');
    }

    public function renderStore() {
      $this->render('Pages/Recipe/store');
    }

    public function renderUpdate($payload) {
      extract($payload);
      $recipe = new Recipe();
      $recipe->id = $id;
      $recipe->user_id = $_SESSION['user_id'];

      $recipe_data = $recipe->findOne();

      if (!isset($recipe_data)) {
        echo "recipe_data não retornou nada";
        return;
      }

      $this->set('recipe', $recipe_data);
      $this->render('Pages/Recipe/update');
    }

    public function store() { 
      $recipe = new Recipe();

      $errors = [];
      
      if (strlen($_POST['title']) < 1) {
        array_push($errors, 'O título da receita é obrigatório');
      }

      if (count($_POST['integrant_title']) < 1) {
        array_push($errors, 'É necessário pelo menos um integrante na receita!');
      }
    
      foreach ($_POST['integrant_title'] as $int_title) {
        if (strlen($int_title) < 1) {
          array_push($errors, 'Os integrantes da receita precisam ter um título!');
        }
      }

      if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        return header('Location: /pratonosso/receitas/criar');
      }

      $recipe->user_id = $_SESSION['user_id'];
      $recipe->title = $_POST['title'];
      $recipe->description = $_POST['description'];

      $stored_recipe = $recipe->store();

      $integrant = new Integrant();

      $integrantsAmount = count($_POST['integrant_title']);

      for ($i = 0; $i < $integrantsAmount; $i++) {
        $integrant->title = $_POST['integrant_title'][$i];
        $integrant->ingredients = $_POST['integrant_ingredients'][$i];
        $integrant->directions = $_POST['integrant_directions'][$i];
        $integrant->recipe_id = $stored_recipe['id'];

        $integrant->store();
      }

      header('Location: /pratonosso/minhas-receitas');
    }

    public function update($payload) {
      extract($payload);

      $recipe = new Recipe();

      $errors = [];
      
      if (strlen($_POST['title']) < 1) {
        array_push($errors, 'O título da receita é obrigatório');
      }

      if (count($_POST['integrant_title']) < 1) {
        array_push($errors, 'É necessário pelo menos um integrante na receita!');
      }
    
      foreach ($_POST['integrant_title'] as $int_title) {
        if (strlen($int_title) < 1) {
          array_push($errors, 'Os integrantes da receita precisam ter um título!');
        }
      }

      if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        return header('Location: /pratonosso/receitas/editar/' . $id);
      }
      
      $recipe->id = $id;
      $recipe->user_id = $_SESSION['user_id'];
      $recipe->title = $_POST['title'];
      $recipe->description = $_POST['description'];

      $stored_recipe = $recipe->update();

      $integrant = new Integrant();

      $integrantsAmount = count($_POST['integrant_title']);
      
      $integrant->recipe_id = $stored_recipe['id'];

      // For now, to update the integrants I'm deleting
      // all of them (from the recipe) and adding it again
      $integrant->deleteAllFromRecipe();

      for ($i = 0; $i < $integrantsAmount; $i++) {
        $integrant->title = $_POST['integrant_title'][$i];
        $integrant->ingredients = $_POST['integrant_ingredients'][$i];
        $integrant->directions = $_POST['integrant_directions'][$i];
        $integrant->recipe_id = $stored_recipe['id'];

        $integrant->store();
      }

      header('Location: /pratonosso/minhas-receitas');
    }

    public function delete($payload) {
      extract($payload);

      $recipe = new Recipe();
      $recipe->id = $id;
      $recipe->user_id = $_SESSION['user_id'];

      $recipe->delete();

      header('Location: /pratonosso/minhas-receitas');
    }

  }