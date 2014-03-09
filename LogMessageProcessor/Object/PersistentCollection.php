<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/17/13 2:15 AM
 * @version 1.0
 */

namespace Tormit\SymfonyHelpersBundle\LogMessageProcessor\Object;


class PersistentCollection
{
    public function __invoke(\Doctrine\ORM\PersistentCollection $message)
    {
        $classes = array();
        foreach ($message as $item) {
            $class = get_class($item);
            if (method_exists($item, '__toString')) {
                $classes[] = '[' . $class . '] ' . (string)$item;
            } else {
                $classes[] = '[' . $class . ']';
            }
        }

        return implode(", ", $classes);
    }

}