<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/17/13 2:11 AM
 * @version 1.0
 */

namespace Tormit\SymfonyHelpersBundle\LogMessageProcessor;
use Tormit\SymfonyHelpersBundle\LogMessageProcessor\Object;
use Tormit\SymfonyHelpersBundle\LogUtil;

class ObjectProcessor
{
    public function __invoke($message)
    {
        $class = explode('\\', get_class($message));
        $classFinal = $class[count($class) - 1];
        LogUtil::debug($classFinal);
        if (class_exists($classFinal)) {
            return new $classFinal();
        }
    }

}