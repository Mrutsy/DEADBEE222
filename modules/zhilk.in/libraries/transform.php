<?php

class transform
{
    public function start ($path, $find_type, $result_type): void
    {

        foreach ( array_diff( scandir( $path ), array( '..', '.' ) ) as $chunk) {

            if (substr(strrchr($chunk, '.'), 1) == $find_type) {

                rename("$path/$chunk", "$path/".basename($chunk, ".$find_type").".$result_type");

            }

        }
    }
}

$start = new transform();
$start->start(__DIR__."/../", "html", "php");