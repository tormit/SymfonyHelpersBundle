<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/9/13 9:27 PM
 * @version 1.0
 */

namespace Tormit\SymfonyHelpersBundle\Tests;


use Tormit\SymfonyHelpersBundle\LogUtil;

class LogUtilTest extends \PHPUnit_Framework_TestCase
{
    protected static $logFile = null;

    public static function setUpBeforeClass()
    {
        // run a logger once to init monolog
        LogUtil::debug('');

        self::$logFile = LogUtil::$logFile;
    }

    protected function readContent()
    {
        return file_get_contents(self::$logFile);
    }

    protected function setUp()
    {
        parent::setUp();

        file_put_contents(self::$logFile, '');
    }

    protected function tearDown()
    {
        parent::tearDown();

        file_put_contents(self::$logFile, '');
    }


    public function testEmergency()
    {
        $log = LogUtil::emergency('LogUtilTest::Emergency test case', 'Whatever');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.EMERGENCY: LogUtilTest::Emergency test case', $content);
    }

    public function testAlert()
    {
        $log = LogUtil::alert('LogUtilTest::Alert test case', 'Whatever');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.ALERT: LogUtilTest::Alert test case', $content);
    }

    public function testError()
    {
        $log = LogUtil::error('LogUtilTest::Error test case', 'Whatever');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.ERROR: LogUtilTest::Error test case', $content);
    }
}