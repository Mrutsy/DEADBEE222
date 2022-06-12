<?php

class attach
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
            echo "Ошибка подключения файла: Не удалось определить тип в указанном пути ($this->dir$path). <br>";
        }
    }
}