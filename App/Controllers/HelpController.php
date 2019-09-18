<?php
  class HelpController extends Controller {
    public function renderIndex() {
      $this->render('Pages/help');
    }
  }