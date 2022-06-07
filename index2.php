<?php
/*
 * ОПИСАНИЕ
 * --- В данном файле хранятся все системные классы и функции для управления проектом.
 */



/*
 * ОТЛАДКА
 * --- Разкомментировать для включения отладки.
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



/*
 * СИСТЕМНЫЙ КЛАСС
 * --- Основной класс проекта.
 */
class SystemProject
{



    /*
     * Создаем функцию конструкции, можно использовать как от корня проекта так и от с определенного места проекта.
     */
    protected string $system_path;

    public function __construct($system_path_user = __DIR__)
    {
        $this->system_path = $system_path_user;
    }



    /*
     * ПОДКЛЮЧЕНИЕ
     * --- Функции для подключения файлов к проекту.
     */

    public function attach ($user_path): void
    {
        try {
            if (is_file($this->system_path . "/" . $user_path)) {

                require_once $this->system_path . "/" . $user_path;

            } elseif (is_dir($this->system_path . "/" . $user_path)) {

                echo "DIR";

            }
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }

    }
}


//        if (is_file($this->system_path."/".$user_path)) {
//
//            try {
//                require_once $this->system_path."/".$user_path;
//            } catch (Exception $e) {
//                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
//            }
//
//            return true;
//        } elseif (is_dir($this->system_path."/".$user_path)) {
//            echo "Это дириектория";
//            return true;
//        } else {
//            return "Ошибка, не корректный путь: '".$this->system_path."/".$user_path."'";
//        }
    //}
//}




$system = new SystemProject(__DIR__);
$system->attach("v/stable/core2.php");





//
//
//class system
//{
//    public function __construct()
//    {
//    }
//
//    private function check_file ($path): bool
//    {
//        if (is_file($path)) {
//            return True;
//        } else {
//            return False;
//        }
//    }
//
//    private function attach_file ($path): void
//    {
//        if ($this->check_file($path)) {
//
//            require_once $path;
//
//        } else {
//            echo "Не удалось подключить файл: ".$path."<br>";
//        }
//    }
//
//    private function attach_files ($path, $type): void
//    {
//        foreach ( array_diff( scandir($path), array('..', '.')) as $chunk) {
//
//            if ( is_file($path."/".$chunk)) {
//
//
//                $expansion = new SplFileInfo($chunk);
//
//                if ($type == "all") {
//
//                    $this->attach_file($path."/".$chunk);
//
//                } else {
//
//                    if ($expansion->getExtension() == $type) {
//
//                        $this->attach_file($path."/".$chunk);
//
//                    }
//
//                }
//
//            } elseif (is_dir($path."/".$chunk)) {
//
//                $this->attach_files($path."/".$chunk, $type);
//
//            }
//
//        }
//    }
//
//    public function attach ($path, $type = Null): bool
//    {
//
//        // Проверяем, подключить нужно все файлы по указанному пути или только определенные.
//        if ($type == Null) {
//            $this->attach_file($path);
//        } else {
//            $this->attach_files($path, $type);
//        }
//        return True;
//    }
//
//    public function route (): void
//    {
//        if (isset($_SESSION['user']['version-site'])) {
//            $this->attach("v/".$_SESSION['user']['version-site']."/core.php");
//        } else {
//            $this->attach("v/stable/core.php");
//        }
//    }
//
//    /*
//     * МОДУЛИ
//     * --- Класс посвященный модулям программы, их управленим и подключением к проекту.
//     */
//
//    // Подключаем библиотеку Composer's
//    private function connect_composer ($path): void
//    {
//        // Если удалось подключить
//        if ($this->attach($path."/modules/composer/vendor/autoload.php")) {
//            echo "ol";
//        }
//
//    }
//
//    public function connect_modules($path): void
//    {
//        echo "ok";
//    }
//}
//
//
//session_start();
//$sys = new system();
//
//$sys->connect_modules(__DIR__);
//
//if ($_POST || $_REQUEST) {
//
//    if ($_POST) {
//        $request = $_POST;
//    } else {
//        $request = $_REQUEST;
//    }
//
//    if ($request['method'] == "api") {
//        echo "Метод: ".$request['method'].". Путь: ".$request['route'];
//    } elseif ($request['method'] == "route") {
//        echo "Метод: ".$request['method'].". Путь: ".$request['route'];
//        $sys->route();
//    } else {
//        echo "Неизвестный метод запроса.";
//    }
//
//
//} else {
//
//    $sys->route();
//
//}
//
//
//
//
//
//
//
//
//
//
//
//
//
