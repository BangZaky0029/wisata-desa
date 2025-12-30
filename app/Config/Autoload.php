<?php

// ===========================================
// FILE: app/Config/Autoload.php
// Add custom helper to autoload
// ===========================================
namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    public $psr4 = [
        APP_NAMESPACE => APPPATH,
    ];

    public $classmap = [];

    public $files = [];

    // Add custom helper here
    public $helpers = ['custom'];
}