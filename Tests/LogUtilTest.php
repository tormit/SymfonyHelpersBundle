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

    protected static function stripBreaksAndSpaces($string)
    {
        $content = str_replace("\n", '', $string);
        $content = str_replace("\r", '', $content);
        $content = str_replace(" ", '', $content);
        return $content;
    }

    public function testEmergency()
    {
        $log = LogUtil::emergency('LogUtilTest::Emergency test case', 'Emergency');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.EMERGENCY: LogUtilTest::Emergency test case', $content);
        $this->assertContains('{"label":"Emergency"}', $content);
    }

    public function testAlert()
    {
        $log = LogUtil::alert('LogUtilTest::Alert test case', 'Alert');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.ALERT: LogUtilTest::Alert test case', $content);
        $this->assertContains('{"label":"Alert"}', $content);
    }

    public function testCritical()
    {
        $log = LogUtil::critical('LogUtilTest::Critical test case', 'Critical');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.CRITICAL: LogUtilTest::Critical test case', $content);
        $this->assertContains('{"label":"Critical"}', $content);
    }

    public function testWarning()
    {
        $log = LogUtil::warning('LogUtilTest::Warning test case', 'Warning');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.WARNING: LogUtilTest::Warning test case', $content);
        $this->assertContains('{"label":"Warning"}', $content);
    }

    public function testError()
    {
        $log = LogUtil::error('LogUtilTest::Error test case', 'Error');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.ERROR: LogUtilTest::Error test case', $content);
        $this->assertContains('{"label":"Error"}', $content);
    }

    public function testNotice()
    {
        $log = LogUtil::notice('LogUtilTest::Notice test case', 'Notice');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.NOTICE: LogUtilTest::Notice test case', $content);
        $this->assertContains('{"label":"Notice"}', $content);
    }

    public function testInfo()
    {
        $log = LogUtil::info('LogUtilTest::Info test case', 'Info');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.INFO: LogUtilTest::Info test case', $content);
        $this->assertContains('{"label":"Info"}', $content);
    }

    public function testDebug()
    {
        $log = LogUtil::debug('LogUtilTest::Debug test case', 'Debug');
        $this->assertNull($log);
        $this->assertFileExists(self::$logFile);

        $content = $this->readContent();
        $this->assertContains('logutil.DEBUG: LogUtilTest::Debug test case', $content);
        $this->assertContains('{"label":"Debug"}', $content);
    }

    public function testArrayProcessor()
    {
        LogUtil::debug(array(1));

        $content = self::stripBreaksAndSpaces($this->readContent());
        $this->assertContains('Array([0]=>1)', $content);
    }

    public function testArrayProcessorMulti()
    {
        LogUtil::debug(array(array(3, 2)));

        // replace spaces and line breaks for testing
        $content = self::stripBreaksAndSpaces($this->readContent());
        $this->assertContains('Array([0]=>Array([0]=>3[1]=>2))', $content);
    }
}