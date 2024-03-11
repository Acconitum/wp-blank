<?php

if (!file_exists(ABSPATH . 'vendor/autoload.php')) {
    die('"composer install" has not been called!');
}

require ABSPATH . 'vendor/autoload.php';

Staempfli\Theme::addActions();