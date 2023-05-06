<?php
require_once 'src\init.php';
use core\App;
header("Location: ". App::getConf()->app_url);