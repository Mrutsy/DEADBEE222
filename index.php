<?php

/*
 * ОТЛАДКА
 * --- Разкомментировать для включения отладки.
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
echo "<pre>";


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


    /*
     * Функция и ее производные по подключению файлов к проекту.
     */

    public function attach ($path, $type = "ALL"): void
    {

        //echo "<br> Запуск функции Attach со значениями:  path - '$path',   type - '$type'. <br>";

        if (is_file($this->dir."/".$path)) {

            //echo "В указанном пути ($path) был обнаружен файл, проверяю, разрешен ли его тип к подключению.<br>";

            if ($type == "ALL") {

                //echo "Так как type = $type, то подключаю данный файл. <br>";
                require_once $this->dir."/".$path;

            } else {

                $expansion = new SplFileInfo($this->dir."/".$path);

                if ($expansion->getExtension() == $type) {

                    //echo "Так как, текущий тип $type разрешен, подключаю файл.<br>";
                    require_once $this->dir."/".$path;

                } else {

                    //echo "Данный тип не подходит к разрешенному типу ($type), пропускаю файл.<br>";

                }

            }

        } elseif (is_dir($this->dir."/".$path)) {

            //echo "По указанному пути ($this->dir/$path) находится дириектория. Захожу в нее. <br>";

            foreach ( array_diff( scandir( $this->dir."/".$path ), array('..', '.')) as $chunk) {

                //echo "Отправляю аргументы в функцию ATTACH. path = $path. <br>";

                if ($chunk == "composer") {
                    $this->attach($path."/".$chunk."/vendor/autoload.php", "php");
                } else {
                    $this->attach($path."/".$chunk, $type);
                }

            }

        } else {
            echo "BAD";
        }
    }

    public function route(): void
    {
        /*
         * Проверяем, авторизован ли пользователь, если авторизован, то заменяем ему в сессии значения маршрутизации.
         */

        if (isset($_SESSION['user']['authKey'])) {
            echo "Пользователь авторизован.<br>";
        } else {
            echo "Пользователь не авторизован.<br>";
        }
    }

    public function appeal (): void
    {

    }


    private function connect_database (): void
    {
        $this->attach("v/stable/modules/system/database/connect.php");
    }

    public function db ()
    {
        $this->connect_database();
    }

    public function message
}


// Проверить метод обращение.






//$sys = new system(__DIR__);
//$sys->attach("v/stable/modules", "php");


session_start();

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
        echo "Метод: ".$request['method'].". Путь: ".$request['route'];
    } elseif ($request['method'] == "route") {
        echo "Метод: ".$request['method'].". Путь: ".$request['route'];
        //$sys->route();
    } else {

        //array_push($_SESSION['user']['systemMessage'], "apple", "raspberry");

        $_SESSION['user']['systemMessage'][]['type'] = "warning";
        $_SESSION['user']['systemMessage'][]['header'] = "Предупреждение!";
        $_SESSION['user']['systemMessage'][]['text'] = "Обнаружен неизвестный метод обращение к проекту.";
        //echo "Обнаружен неизвестный метод обращение к проекту. Переадресовываю на главную страницу.<br>";
        var_dump($_SESSION['user']['systemMessage']);
    }


} else {
    echo "hmmm";
    //$sys->route();
}