<?php

define('APP', __DIR__);

spl_autoload_register(function ($klass) {
    $klassFile = APP . '/' . strtolower(str_replace('\\', '/', $klass)) . '.php';
    if (is_file($klassFile) || is_link($klassFile)) {
        include $klassFile;
    }
});

session_name('dksess');
session_cache_limiter('nocache');
session_start();