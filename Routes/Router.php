<?php 
  require_once 'Routes/Parser.php';
  require_once 'Routes/Auth.php';

  class Route {
    private static $validRoutes = array();

    public static function get($route, $class_method, $is_private = false) {
      array_push(self::$validRoutes, $route);

      Parser::dispatch($route, $class_method, $is_private);
    }
  }

?>