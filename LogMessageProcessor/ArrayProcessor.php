<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 5:30 PM
 * @version 1.0
 */

namespace Tormit\SymfonyHelpersBundle\LogMessageProcessor;


class ArrayProcessor
{

    public function __invoke(array $array)
    {
        return print_r($array, true);
    }
}