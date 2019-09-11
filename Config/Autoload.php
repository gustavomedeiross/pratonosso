<?php

  if (file_exists('env.php')) {
    require_once 'env.php';
  }

  if (!function_exists('env')) {
    function env ($key, $default = null) {
      $value = getenv($key);

      if ($value === false) {
        return $default;
      }

      return $value;
    }
  }

?>