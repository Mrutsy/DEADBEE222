<?php
/*
 * ОТЛАДКА
 * --- Разкомментировать для включения отладки.
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL );

class system
{
    /**
     * @var mixed|string
     */
    protected mixed $dir;

    public function __construct ($current_dir = __DIR__)
    {
        $this->dir = $current_dir;
    }

    private function logger(): array
    {
        return [];
    }

    /*
     * Функция для подключения как отдельных файлов так и подключение файлов по пути дириектории.
     * Имеет фильтр подлкючения по типам файлов или названии дириектории.
     * v: 0.1
     */
    public function attach($path): void
    {

        /*
         * Проверяем, является ли полученный путь в переменной $path файлом или дириекторией.
         */
        if (is_file($this->dir."/".$path)) {

            //echo "$this->dir$path - файл, подключаю <br>";

            /*
             * Если является файлом, то подключаем его.
             */

            require_once $path;

            //return sprintf("Файл: %s - подключен. <br>", $path);

        } elseif (is_dir($this->dir."/".$path)) {

            //echo "$this->dir$path - дириектория<br>";

            /*
             * Если полученный путь является дириекторией.
             */
            foreach ( array_diff( scandir( $this->dir."/".$path ), array('..', '.')) as $chunk) {

                //echo "Получаю первую позицию в дириектории ($chunk). <br>";

                /*
                 * Вызываем текущую функцию со смещением в указанную дириекторию.
                 */

                $this->attach($path."/".$chunk);

            }

        } else {

            /*
             * Выводим информацию об ошибке.
             */

            //return sprintf("<br>ОШИБКА: По указанному пути ('%s') не существует файла или папки. <br>", $path);
        }

        //return "Подключение выполнено успешно! <br>";
    }
}

/*
 * Создание системного класса с указанием текущей дириектории.
 */
$sys = new system(__DIR__);

/*
 * Подключение библиотеки Composer.
 */
$sys->attach("modules/composer/vendor/autoload.php");



/*
 * Подключение базы данных и получение настроек проекта.
 */
$sys->attach("modules/database/connect.php");

$info_site = $GLOBALS['db']->query("SELECT * FROM `settings`", 30);
$info_site = $info_site->fetchAssoc();

if (!$info_site['availability']) {
    exit("Сайт закрыт администратором на техническое обслуживание!<br>");
}


/*
 * Создание сессии.
 */
session_start();


/*
 * Маршрутизация по проекту.
 */
if ($_POST || $_REQUEST) {

    if ($_POST) {
        $request = $_POST;
    } else {
        $request = $_REQUEST;
    }

    if ($request['method'] == "api") {

        echo "Метод: ".$request['method'].". Путь: ".$request['route'];

    } elseif ($request['method'] == "route") {

        echo "Метод: ".$request['method'].". Путь: ".$request['route'];

    }  elseif ($request['method'] == "authorization") {

        if (!empty($request['username']) && !empty($request['password'])) {

            $check = $GLOBALS['db']->query("SELECT * FROM `users` WHERE username = '" . $request['username'] . "' AND password = '" . $request['password'] . "'", 30);
            $check = $check->fetchAssoc();

            if ($check) {
                $_SESSION['error']['text'] = "Вход разрешен. Привет: ".$check['username'];
            } else {
                $_SESSION['error']['text'] = "Неправильный логин или пароль.";
            }

        } else {
            $_SESSION['error']['text'] =  "Невозможно ввести пустоту.";
        }

        $sys->attach("modules/".$info_site['projectModulesDefault']."/libraries");
        $sys->attach("modules/".$info_site['projectModulesDefault']."/cpSign.php");

//        if ($GLOBALS['db']->query("SELECT * FROM `users` WHERE username = '".$request['username']."' AND password = '".$request['password']."'", 30)) {
//            echo "ok";
//        } else {
//            echo "bad";
//        }
//
//        echo "Запрос на авторизацию".$request['username'].$request['password'];

    } else {
        echo "Неизвестный метод запроса.";
    }


} else {

    if (isset($_SESSION['user'])) {

        echo "Сайтик.";

    } else {
        $sys->attach("modules/".$info_site['projectModulesDefault']."/libraries");
        $sys->attach("modules/".$info_site['projectModulesDefault']."/cpSign.php");
    }



}
