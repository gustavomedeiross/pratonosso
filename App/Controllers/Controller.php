<?php
  class Controller {
    private $data = [];
    private $layout = "default";

    public function set($variable_name, $d) {
      $this->data[$variable_name] = $d;
    }

    public function render($path_to_view) {
      extract($this->data);
      ob_start(); // Store the HTML in the buffer 
      require_once 'App/Views/' . $path_to_view . '.php';

      // Stores the buffer content in this variable and deletes after
      $content_for_layout = ob_get_clean(); 
      
      if ($this->layout == false) {
        return $content_for_layout;
      }

      require_once 'App/Views/Layouts/' . $this->layout . '.php';
    }
  }
?>