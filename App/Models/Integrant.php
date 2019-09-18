<?php
  class Integrant extends Model {
    private $connection;
    private $table = 'integrants';
    private $rel_table = 'recipes';

    public $id;
    public $title;
    public $ingredients;
    public $directions;
    public $recipe_id;
    public $created_at;
    public $updated_at;

    public function __construct() {
      $this->connection = Database::connect();
    }

    public function store() {
      $this->title = $this->secureInput($this->title);
      $this->ingredients = $this->secureInput($this->ingredients);
      $this->directions = $this->secureInput($this->directions);
      $this->recipe_id = $this->secureInput($this->recipe_id);

      $query = 'INSERT INTO ' . $this->table . ' SET title = :title, ingredients = :ingredients, directions = :directions, recipe_id = :recipe_id';

      $stmt = $this->connection->prepare($query);

      $stmt->bindParam('title', $this->title);
      $stmt->bindParam('ingredients', $this->ingredients);
      $stmt->bindParam('directions', $this->directions);
      $stmt->bindParam('recipe_id', $this->recipe_id);

      $stmt->execute();

      $integrant = ['title' => $this->title, 'ingredients' => $this->ingredients, 'directions' => $this->directions, 'recipe_id' => $this->recipe_id];

      return $integrant;
    }

    public function update() {
      // Not used
    }

    public function delete() {
      $this->id = $this->secureInput($this->id);

      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id && recipe_id = :recipe_id';

      $stmt = $this->connection->prepare($query);
      $stmt->execute(['id' => $this->id, 'recipe_id' => $this->recipe_id]);

      return true;
    }

    public function deleteAllFromRecipe() {
      $this->recipe_id = $this->secureInput($this->recipe_id);

      $query = 'DELETE FROM ' . $this->table . ' WHERE recipe_id = :recipe_id';
      
      $stmt = $this->connection->prepare($query);
      $stmt->execute(['recipe_id' => $this->recipe_id]);

      return true;
    }
  }