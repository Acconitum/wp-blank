<?php

var_dump(ABSPATH . 'vendor/autoload.php');

var_dump(__DIR__);

if (file_exists(ABSPATH . 'vendor/autoload.php')) {

} else {
    die('"composer install" has not been called!');
}

Staempfli\Theme::addActions();