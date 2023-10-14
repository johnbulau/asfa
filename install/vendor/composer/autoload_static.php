<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite463ba0dbf65b045f21e60b6afff8958
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Php\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Php\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php',
        ),
    );

    public static $classMap = array (
        'Php\\DbImport' => __DIR__ . '/../..' . '/php/DbImport.php',
        'Php\\FileWrite' => __DIR__ . '/../..' . '/php/FileWrite.php',
        'Php\\Requirements' => __DIR__ . '/../..' . '/php/Requirements.php',
        'Php\\Validation' => __DIR__ . '/../..' . '/php/Validation.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite463ba0dbf65b045f21e60b6afff8958::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite463ba0dbf65b045f21e60b6afff8958::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite463ba0dbf65b045f21e60b6afff8958::$classMap;

        }, null, ClassLoader::class);
    }
}
