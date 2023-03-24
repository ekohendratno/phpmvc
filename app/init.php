<?php

if( !session_id() ) session_start();

require_once "config/config.php";
require_once "core/Database.php";
require_once "core/Flasher.php";
require_once "core/App.php";
require_once "core/Controller.php";

$app = new App();