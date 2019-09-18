<?php
  class PresentationController extends Controller {
    public function renderIndex() {
      $this->render('Pages/presentation');
    }
  }