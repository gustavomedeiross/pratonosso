<?php
  class Recipe extends Model {
    private $connection;
    private $table = 'recipes';
    private $rel_table = 'integrants';

    public $id;
    public $title;
    public $description;
    public $footnote;
    public $user_id; // Verify
    public $created_at;
    public $updated_at;

    public function __construct() {
      $this->connection = Database::connect();
    }

    public function findAll($limit, $offset) {
      $query = 'SELECT * FROM ' . $this->table . ' LIMIT :limit  OFFSET :offset';
      $stmt = $this->connection->prepare($query);
      $stmt->execute(['limit'=>$limit, 'offset'=>$offset]);

      return $stmt->fetchAll();
    } 

    public function findAllByUser() {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id';
      $stmt = $this->connection->prepare($query);

      $stmt->bindParam('user_id', $this->user_id);
      $stmt->execute();

      return $stmt->fetchAll();
    }

    public function findOne() {
      $query = 'SELECT r.id, r.title, r.description, r.footnote, r.user_id, i.id as integrant_id, i.title as
      integrant_title, i.ingredients as integrant_ingredients, i.directions as
      integrant_direction FROM ' . 
      $this->table . ' r INNER JOIN ' . $this->rel_table . ' i ON i.recipe_id = r.id AND 
      i.recipe_id = :id AND r.user_id = :user_id';

      $stmt = $this->connection->prepare($query);
      $stmt->execute(['id'=>$this->id, 'user_id'=>$this->user_id]);
      return $stmt->fetchAll();
    }

    public function store() {
      $this->title = $this->secureInput($this->title);
      $this->description = $this->secureInput($this->description);
      $this->user_id = $this->secureInput($this->user_id);

      $query = 'INSERT INTO ' . $this->table . ' SET title = :title, description = :description, user_id = :user_id';

      $stmt = $this->connection->prepare($query);

      $stmt->bindParam('title', $this->title);
      $stmt->bindParam('description', $this->description);
      $stmt->bindParam('user_id', $this->user_id);

      $stmt->execute();

      $recipe = ['id' => $this->connection->lastInsertId(), 'title' => $this->title, 'description' => $this->description, 'user_id' => $this->user_id];

      return $recipe;
    }

    public function update() {
      $this->id = $this->secureInput($this->id);
      $this->title = $this->secureInput($this->title);
      $this->description = $this->secureInput($this->description);
      $this->user_id = $this->secureInput($this->user_id);

      $query = 'UPDATE ' . $this->table . ' SET title = :title, description = :description WHERE id = :id && user_id = :user_id';

      $stmt = $this->connection->prepare($query);

      $stmt->bindParam('title', $this->title);
      $stmt->bindParam('description', $this->description);
      $stmt->bindParam('id', $this->id);
      $stmt->bindParam('user_id', $this->user_id);

      $stmt->execute();

      $recipe = ['id' => $this->id, 'title' => $this->title, 'description' => $this->description, 'user_id' => $this->user_id];

      return $recipe;
    }

    public function delete() {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id && user_id = :user_id';

      $stmt = $this->connection->prepare($query);
      $stmt->execute(['id' => $this->id, 'user_id' => $this->user_id]);

      return true;
    }


  }