<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit6e6b7af54d2644cb440017a9d05dd56c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit6e6b7af54d2644cb440017a9d05dd56c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit6e6b7af54d2644cb440017a9d05dd56c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit6e6b7af54d2644cb440017a9d05dd56c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
