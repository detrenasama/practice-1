<?php

namespace App\Controllers;

class SiteController {
    public function actionIndex() {
        include_once("pages/home.php");
    }
}