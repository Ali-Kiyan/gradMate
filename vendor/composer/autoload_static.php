<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0fd47bd96a6be4f16e56a98e5739623
{
    public static $prefixesPsr0 = array (
        'K' => 
        array (
            'Kachkaev\\PHPR\\' => 
            array (
                0 => __DIR__ . '/..' . '/kachkaev/php-r/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf0fd47bd96a6be4f16e56a98e5739623::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}