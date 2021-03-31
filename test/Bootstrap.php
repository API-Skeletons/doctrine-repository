<?php

namespace ApiSkeletonsTest\Doctrine\Repository;

use Laminas\Loader\AutoloaderFactory;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);
date_default_timezone_set('utc');

/**
 * Test bootstrap, for setting up autoloading
 *
 * @subpackage UnitTest
 */
class Bootstrap
{
    protected static $serviceManager;

    public static function init()
    {
        static::initAutoloader();
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
            return;
        }

        $LaminasPath = getenv('Laminas_PATH') ?: (defined('Laminas_PATH') ? Laminas_PATH : (is_dir($vendorPath . '/Laminas/library') ? $vendorPath . '/Laminas/library' : false));

        if (!$LaminasPath) {
            throw new RuntimeException('Unable to load Laminas. Run `php composer.phar install` or define a Laminas_PATH environment variable.');
        }

        if (isset($loader)) {
            $loader->add('Zend', $LaminasPath . '/Zend');
        } else {
            include $LaminasPath . '/Zend/Loader/AutoloaderFactory.php';
            AutoloaderFactory::factory(array(
                'Zend\Loader\StandardAutoloader' => array(
                    'autoregister_zf' => true,
                    'namespaces' => array(
                        'ZF\Doctrine\Repository' => __DIR__ . '/../src/',
                        __NAMESPACE__ => __DIR__,
                    ),
                ),
            ));
        }
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
}

Bootstrap::init();
