<?php

require  'funciones.php';

require 'config/database.php';

require __DIR__ .'/../vendor/autoload.php';
//conectar a la BD

$db = conectorDB();

use Model\activeRecord;

activeRecord::setDB($db);