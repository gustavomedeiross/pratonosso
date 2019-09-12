<?php 
  class Model {
    protected function secureInput($string) {
      return htmlspecialchars(strip_tags($string));
    }
  }