<?php

class system
{
    public function __construct()
    {
    }

    private function check_file ($path): bool
    {
        if (is_file($path)) {
            return True;
        } else {
            return False;
        }
    }

    private function attach_file ($path): void
    {
        if ($this->check_file($path)) {

            require_once $path;

        } else {
            echo "Не удалось подключить файл: ".$path."<br>";
        }
    }

    private function attach_files ($path, $type): void
    {
        foreach (scandir($path, 1) as $chunk) {

            if (is_file($path."/".$chunk)) {


                $expansion = new SplFileInfo($chunk);

                if ($type == "all") {

                    $this->attach_file($path."/".$chunk);

                } else {

                    if ($expansion->getExtension() == $type) {

                        $this->attach_file($path."/".$chunk);

                    }

                }

            } elseif (is_dir($path."/".$chunk)) {

                if (!$chunk == "." || !$chunk == "..") {

                    $this->attach_files($path."/".$chunk, $type);

                }

            }

        }
    }

    public function attach ($path, $type = Null): void
    {

        // Проверяем, подключить нужно все файлы по указанному пути или только определенные.
        if ($type == Null) {
            $this->attach_file($path);
        } else {
            $this->attach_files($path, $type);
        }
    }
}




$sys = new system();
$sys->attach("v/stable/core.php");














//
//
///**
// * @property $path
// * @property $type
// */
//class system
//{
//
//
//
//    public function __construct()
//    {
//    }
//
//
//
//
//
//    private function attach_file($path)
//    {
//        require_once $path;
//
//    }
//
//
//
//
//    private function attach_files ($path, $type)
//    {
//
//        foreach (scandir($path, 1) as $chunk) {
//
//            if (is_file($path."/".$chunk)) {
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
//                if (!$chunk == "." || !$chunk == "..") {
//
//                    $this->attach_files($path."/".$chunk, $type);
//
//                }
//
//            }
//
//        }
//
//    }
//
//
//
//    /*
//     * Публичная универсальная функция, для подключения файлов с кодом.
//     */
//    public function attach($path, $type)
//    {
//
//        if (is_file($path)) {
//
//            $this->attach_file($path);
//
//        } elseif (is_dir($path)) {
//
//            $this->attach_files($path, $type);
//
//        } else {
//            echo "Не удалось определить тип поключаемого файла или дириектории.";
//        }
//
//    }
//
//}
//
//$system = new system();
//$system->attach("v/stable/libraries/my", "all");
//
//






//    if ($all) {
//
//        while ($filename = readdir(opendir($path)))
//
//
//        $dir = "наш каталог";
//        $catalog = opendir($dir);
//
//        while ($filename = readdir($catalog )) // перебираем наш каталог
//        {
//            $filename = $dir."/".$filename;
//            include_once($filename); // один раз подрубаем, чтоб не повторяться
//        }
//
//        closedir($catalog);
//    }
//
//
//    // TODO Допилить функцию, что бы выводило корректно ошибку, если файл не может быть выполнен.
//    if (is_readable($path)) {
//        require_once $path;
//    } else {
//        echo "Ошибка открытия файла.";
//    }






//
//if ($_POST || $_REQUEST) {
//
//    if ($_POST['method'] == 'api' || $_REQUEST['method'] == 'api') {
//
//        echo "Используется API method";
//
//        if (isset($_POST['api_version']) || isset($_REQUEST['api_version'])) {
//
//            echo "Вы используете АПИ версии которая есть.";
//
//        } else {
//
//            echo "Не указана версия АПИ, использую стабильную.";
//
//        }
//
//    } else {
//
//        echo "Не обнаружен метод запроса.";
//
//    }
//
//} else {
//
//    if (isset($_SESSION['user']) && isset($_SESSION['user']['version_site'])) {
//
//        attach('v/'.$_SESSION['user']['version_site'].'/core.php');
//
//    } else {
//
//        attach('v/stable/core.php');
//
//    }
//
//}
//
//function database ($msg) {
//    echo $msg;
//}

//$system = new system();
//$system->attach("v");