<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/23/13 5:56 PM
 * @version 1.0
 */

namespace Tormit\SymfonyHelpersBundle;

use Monolog;
use Tormit\SymfonyHelpersBundle\LogMessageProcessor\ArrayProcessor;

/**
 * Class LogUtil
 *
 * @version 3.0 Using Monolog
 *
 * @package PMS
 */
class LogUtil
{

    /**
     * @var $monolog Monolog\Logger
     */
    protected static $monolog = null;

    protected static function initMonolog($message, $flags = 0)
    {
        if (self::$monolog === null) {
            self::$monolog = new Monolog\Logger('logutil');

            self::$monolog->pushHandler(new Monolog\Handler\StreamHandler(dirname($_SERVER['SCRIPT_FILENAME']) . '/../app/logs/logutil.log'));
            self::$monolog->pushProcessor(new Monolog\Processor\MemoryUsageProcessor());
            //self::$monolog->pushProcessor(new Monolog\Processor\IntrospectionProcessor());
            self::$monolog->pushProcessor(new Monolog\Processor\WebProcessor());
        }
    }

    public static function emergency($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addEmergency($message, array('label' => $label));
    }

    public static function alert($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addAlert($message, array('label' => $label));
    }

    public static function critical($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addCritical($message, array('label' => $label));
    }

    public static function warning($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addWarning($message, array('label' => $label));
    }

    public static function error($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addError($message, array('label' => $label));
    }

    public static function notice($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addNotice($message, array('label' => $label));
    }

    public static function info($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addInfo($message, array('label' => $label));
    }

    public static function debug($message, $label = '', $flags = 0)
    {
        self::initMonolog($message, $flags);

        self::$monolog->addDebug(call_user_func(self::getMessageProcessor($message), $message), array('label' => $label));
    }


    protected static function getMessageProcessor($message)
    {
        if (is_array($message)) {
            return new ArrayProcessor();
        }

        return function ($message) {
            return $message;
        };
    }
}