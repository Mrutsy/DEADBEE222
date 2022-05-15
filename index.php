<?php


/*
 * Разкомментировать для включения отладки.
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);





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
        foreach ( array_diff( scandir($path), array('..', '.')) as $chunk) {

            if ( is_file($path."/".$chunk)) {


                $expansion = new SplFileInfo($chunk);

                if ($type == "all") {

                    $this->attach_file($path."/".$chunk);

                } else {

                    if ($expansion->getExtension() == $type) {

                        $this->attach_file($path."/".$chunk);

                    }

                }

            } elseif (is_dir($path."/".$chunk)) {

                $this->attach_files($path."/".$chunk, $type);

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

    public function route (): void
    {
        if (isset($_SESSION['user']['version-site'])) {
            $this->attach("v/".$_SESSION['user']['version-site']."/core.php");
        } else {
            $this->attach("v/stable/core.php");
        }
    }
}


session_start();
$sys = new system();



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
        $sys->route();
    } else {
        echo "Неизвестный метод запроса.";
    }


} else {

    $sys->route();

}
