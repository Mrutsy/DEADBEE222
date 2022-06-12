<?php

class transform
{
    public function start ($path, $find_type, $result_type): void
    {

        foreach ( array_diff( scandir( $path ), array( '..', '.' ) ) as $chunk) {

            if (substr(strrchr($chunk, '.'), 1) == $find_type) {

                //echo 'modules/'.basename(__DIR__)."/assets/";
                //echo $path.$chunk."<br>";
                $file_contents = file_get_contents($path.$chunk);
                $file_contents = str_replace("assets/", "<?php echo 'modules/'.basename(__DIR__); ?>/assets/", $file_contents);
                file_put_contents($path.$chunk, $file_contents);

                rename("$path/$chunk", "$path/".basename($chunk, ".$find_type").".$result_type");

            }

        }
    }
}

$start = new transform();
$start->start(__DIR__."/../", "html", "php");

//echo "modules/" . basename(__DIR__);