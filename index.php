<?php
/*
 * DEADBEE - Данный проект был задуман, как легкий помошник в настройке и развертывании своего собственного сайта на
 * модульной основе, с версиями для каждого клиента.
 * Создан мною для меня и немного для Вас:)
 */



/*
 * ОТЛАДКА
 * --- Раскомментировать для включения отладки.
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
echo "<pre>";
// ------------------------------------------------>



// Запускаем функцию начала сессии.
session_start();
//session_destroy();

/*
 * Подключаем функцию для подлкючения файлов.
 */
require_once __DIR__."/v/stable/modules/system/libraries/attach.php";





$attach = new attach();
$attach->attach("../composer/vendor/autoload.php");
$attach->attach("../database/connect.php");



/*
 * Обрабатываем событие, при котором к проекту обращаются с помощью запросов.
 */
if ($_POST || $_REQUEST) {

    if ($_POST) {
        $request = $_POST;
    } else {
        $request = $_REQUEST;
    }

    if ($request['method'] == "api") {

        echo "Метод: ".$request['method'];

    } elseif ($request['method'] == "route") {

        echo "Метод: ".$request['method'].". Путь: ".$request['route'];

    } else {

        //array_push($_SESSION['user']['systemMessage'], "apple", "raspberry");

        $_SESSION['user']['systemMessage'][]['type'] = "warning";
        $_SESSION['user']['systemMessage'][]['header'] = "Предупреждение!";
        $_SESSION['user']['systemMessage'][]['text'] = "Обнаружен неизвестный метод обращение к проекту.";
        //echo "Обнаружен неизвестный метод обращение к проекту. Переадресовываю на главную страницу.<br>";
        var_dump($_SESSION['user']['systemMessage']);
    }


} else {

    echo "Сайт открыт в обычном режиме.<br>";

    if (isset($_SESSION['user']['versionProject'])) {
        echo "У пользователя есть версия.<br>";
        echo $_SESSION['user']['versionProject'];
    } else {
        echo "У пользователя нет версии.<br>";

        $projectInfo = $GLOBALS['db']->query("SELECT * FROM settings", 123);
        $projectInfo = $projectInfo->fetchAssoc();
        var_dump($projectInfo);

        $_SESSION['user']['versionProject'] = $projectInfo['projectVersionDefault'];
        var_dump($_SESSION['user']);
    }


}