<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit120dd4e0e8b4e5e427aa78dd3ff77540
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pyramit\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pyramit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit120dd4e0e8b4e5e427aa78dd3ff77540::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit120dd4e0e8b4e5e427aa78dd3ff77540::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit120dd4e0e8b4e5e427aa78dd3ff77540::$classMap;

        }, null, ClassLoader::class);
    }
}