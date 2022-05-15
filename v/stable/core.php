<?php


/*
 * Основной логический файл, обрабатывающий вс. логическую часть версии.
 */


$sys = new system();



// Подключение модуля Composer и его библиотек.
$sys->attach(__DIR__."/modules/composer/vendor/autoload.php");
// Подключение модуля базы данных.
$sys->attach(__DIR__."/modules/database/", "php");



/*
 * ИНИЦИАЛИЗАЦИЯ МОДУЛЕЙ.
 *
 * Обращаемся к базе данных на получение списка установленных в системе модулей, записываем их в массив.
 * Считываем фактические установленные модули, их версии.
 * Сравниваем данные с БД и фактические, если разнятся версии или есть новые, то оповещаем об этом.
 * После прочтения обновляем инфу с БД.
 *
 * Далее, подключаем фактические модули из списка с БД в котором есть разрешение на подключение.
 */

$list_modules_fact = array();
$modules_info = "";



// Получаю список модулей из БД.
$list_modules_db = $GLOBALS['db']->query("select * from modules");
$list_modules_db = $list_modules_db->fetchAssocArray();



// Получаю фактический список модулей.



foreach (array_diff( scandir(__DIR__."/modules/"), array('..', '.')) as $chunk) {

    if ($chunk !== "composer") {

        $sys->attach(__DIR__."/modules/".$chunk."/lib/", "php");
        //include(__DIR__."/modules/".$chunk."/version.php");


        //$valid_modules = array_search($modules_info['key'], $list_modules_db['key']);

       // echo $valid_modules;


        //echo $modules_info['key']."<br>";

        //$list_modules_fact[] = $modules_info;

    }

}


//while (True) {
//
//    if ()
//}
//
//
//if (array_search($modules_info['key'], $list_modules_db['key'])) {
//    echo "Ключ найден";
//}








// Получаю список модулей из БД.
//$list_modules_db = $GLOBALS['db']->query("select * from modules");
//var_dump($list_modules_db);
//$list_modules_db = $list_modules_db->fetchAssocArray();
////echo "<br>";
//var_dump($list_modules_db);
//echo "<br>";

//
//// Получаю фактический список модулей.
//
//$list_modules_fact = array();
//
//foreach (array_diff( scandir(__DIR__."/modules/"), array('..', '.')) as $chunk) {
//
//    if ($chunk !== "composer") {
//
//        $modules_info = "";
//
//
//        include(__DIR__."/modules/".$chunk."/version.php");
//
//        $list_modules_fact[] = $modules_info;
//
//    }
//
//}
//
////var_dump($list_modules_fact);
//
//// Сравниваем фактические модули с БД.
//
//foreach ($list_modules_fact as $itemFact) {
//
//    foreach ($list_modules_db as $itemDB) {
//
//        if ($itemDB['name'] == $itemFact['name'] && $itemDB['version'] == $itemFact['version']) {
//
//            echo "<br>Одинаковые модули.<br>";
//
//        } else {
//            echo "<br>Разные модули.<br>";
//        }
//
//    }

    //if ($list_modules_db['version'] == $list_modules_fact['version'])



//}



/*
 * АУЕНТИФИКАЦИЯ И МАРШРУТИЗАЦИЯ
 */
$sys->attach(__DIR__."/modules/face/index.php");