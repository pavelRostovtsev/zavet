<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function dd($str) {
    echo '<pre style="background: #000; color: #fff">';
    var_dump($str);
    echo '</pre>';
    exit;
}

#[NoReturn]
function dump($str) {
    echo '<pre style="background: #000; color: #fff">';
    var_dump($str);
    echo '</pre>';
    echo '<hr>';

}
