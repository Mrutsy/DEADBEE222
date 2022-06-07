<?php


$sys = new system();



// Подключение модуля Composer и его библиотек.
$sys->attach(__DIR__."/modules/composer/vendor/autoload.php");
// Подключение модуля базы данных.
$sys->attach(__DIR__."/modules/database/", "php");
