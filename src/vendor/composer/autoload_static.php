<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfdb22f79a4eb57e60ee10c1d68beadb5
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'XENONMC\\XPFRAME\\vendor\\Router\\' => 30,
            'XENONMC\\XPFRAME\\vendor\\Mvc\\' => 27,
            'XENONMC\\XPFRAME\\' => 16,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'XENONMC\\XPFRAME\\vendor\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/xenonmc/xpframe-router/src',
        ),
        'XENONMC\\XPFRAME\\vendor\\Mvc\\' => 
        array (
            0 => __DIR__ . '/..' . '/xenonmc/xpframe-mvc/src',
        ),
        'XENONMC\\XPFRAME\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfdb22f79a4eb57e60ee10c1d68beadb5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfdb22f79a4eb57e60ee10c1d68beadb5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfdb22f79a4eb57e60ee10c1d68beadb5::$classMap;

        }, null, ClassLoader::class);
    }
}
