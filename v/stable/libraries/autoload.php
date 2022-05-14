<?php

// Создание системного обьекта.
$system = new system();


// Подключение библиотек предоставленным композером.
$system->attach(__DIR__ . "/composer/vendor/autoload.php", "all");

// Подключение своих библиотек.
$system->attach(__DIR__."/my", "php");
