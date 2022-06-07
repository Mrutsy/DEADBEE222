<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc66f007864b391d8ef89ec5d8ead8956
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Krugozor\\Database\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Krugozor\\Database\\' => 
        array (
            0 => __DIR__ . '/..' . '/krugozor/database/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc66f007864b391d8ef89ec5d8ead8956::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc66f007864b391d8ef89ec5d8ead8956::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc66f007864b391d8ef89ec5d8ead8956::$classMap;

        }, null, ClassLoader::class);
    }
}