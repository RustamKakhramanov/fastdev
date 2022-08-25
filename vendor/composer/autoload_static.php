<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd321cdc3d25dca90670f9ea75f5d0f3
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kraify\\Fastdev\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kraify\\Fastdev\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd321cdc3d25dca90670f9ea75f5d0f3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd321cdc3d25dca90670f9ea75f5d0f3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd321cdc3d25dca90670f9ea75f5d0f3::$classMap;

        }, null, ClassLoader::class);
    }
}
