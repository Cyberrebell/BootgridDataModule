<?php

namespace BootgridDataModule;

class Module
{
    function getConfig() {
        return require __DIR__ . '/config/module.config.php';
    }
}
