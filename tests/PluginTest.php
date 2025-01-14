<?php

use PHPUnit\Framework\TestCase;

/**
 * Class PluginTest
 * @ignore
 */
class PluginTest extends TestCase
{
    /**
     * @covers MC4WP_Plugin::file
     */
    public function test_file()
    {
        $plugin = new MC4WP_Plugin(__FILE__, '2.5.3');
        self::assertEquals($plugin->file(), __FILE__);

        $file = '/some/other/file.php';
        $plugin = new MC4WP_Plugin($file, '2.5.3');
        self::assertEquals($plugin->file(), $file);
    }

    /**
     * @covers MC4WP_Plugin::dir
     */
    public function test_dir()
    {
        $plugin = new MC4WP_Plugin(__FILE__, '2.5.3');
        self::assertEquals($plugin->dir(), dirname(__FILE__));

        $file = '/some/other/file.php';
        $dir = dirname($file);
        $plugin = new MC4WP_Plugin($file, '2.5.3');
        self::assertEquals($plugin->dir(), $dir);

        $plugin = new MC4WP_Plugin(__FILE__, '2.5.3');
        self::assertEquals($plugin->dir('leading-slash'), dirname(__FILE__) . '/leading-slash');
    }

    /**
     * @covers MC4WP_Plugin::version
     */
    public function test_version()
    {
        $version = '2.5.3';
        $plugin = new MC4WP_Plugin(__FILE__, $version);
        self::assertEquals($plugin->version(), $version);

        $version = '1.0';
        $plugin = new MC4WP_Plugin(__FILE__, $version);
        self::assertEquals($plugin->version(), $version);
    }
}
