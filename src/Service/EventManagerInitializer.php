<?php
/**
 * This source file is part of Xloit project.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * <http://www.opensource.org/licenses/mit-license.php>
 * If you did not receive a copy of the license and are unable to obtain it through the world-wide-web,
 * please send an email to <license@xloit.com> so we can send you a copy immediately.
 *
 * @license   MIT
 * @link      http://xloit.com
 * @copyright Copyright (c) 2016, Xloit. All rights reserved.
 */

namespace Xloit\Bridge\Zend\EventManager\Service;

use Xloit\Bridge\Zend\ServiceManager\AbstractServiceInitializer;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * An {@link EventManagerInitializer} class.
 *
 * @package Xloit\Bridge\Zend\EventManager\Service
 */
class EventManagerInitializer extends AbstractServiceInitializer
{
    /**
     *
     *
     * @return string
     */
    protected function getAwareInstanceInterface()
    {
        return EventManagerAwareInterface::class;
    }

    /**
     *
     *
     * @return string
     */
    protected function getInstanceInterface()
    {
        return EventManagerInterface::class;
    }

    /**
     *
     *
     * @return array
     */
    protected function getServiceNames()
    {
        return [
            'xloit.event.eventManager',
            EventManager::class,
            'EventManager'
        ];
    }

    /**
     *
     *
     * @return array
     */
    protected function getMethods()
    {
        return [
            'getter' => 'getEventManager',
            'setter' => 'setEventManager'
        ];
    }
}
