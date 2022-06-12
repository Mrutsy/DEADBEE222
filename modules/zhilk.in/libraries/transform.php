<?php

class transform
{
    public function start ($path, $find_type, $result_type): void
    {
        foreach ( array_diff( scandir( $path ), array( '..', '.' ) ) as $chunk) {

            echo $chunk;

        }
    }
}

$start = new transform();
$start->start(__DIR__."../", "html", "php");