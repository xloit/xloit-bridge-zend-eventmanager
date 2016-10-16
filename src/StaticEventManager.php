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

namespace Xloit\Bridge\Zend\EventManager;

use Zend\EventManager\SharedEventManager;
use Zend\EventManager\SharedEventManagerInterface;

/**
 * A {@link StaticEventManager} class.
 *
 * @package Xloit\Bridge\Zend\EventManager
 */
class StaticEventManager extends SharedEventManager
{
    /**
     * Retrieve StaticEventManager instance.
     *
     * @var SharedEventManagerInterface
     */
    protected static $instance;

    /**
     * Trigger all listeners for a given event.
     * Can emulate triggerUntil() if the last argument provided is a callback.
     *
     * @param string                                   $id
     * @param string|\Zend\EventManager\EventInterface $event
     * @param string|mixed                             $target
     * @param array|\Traversable                       $argv
     *
     * @return \Zend\EventManager\ResponseCollection All listener return values
     */
    public function trigger($id, $event, $target = null, $argv = [])
    {
        /** @var \Zend\EventManager\EventManagerInterface $currentEvent */
        $currentEvent = $this->getEvent($id);

        if ($currentEvent) {
            return $currentEvent->trigger($event, $target, $argv);
        }

        return false;
    }

    /**
     * Retrieve event.
     *
     * @param string $id
     *
     * @return SharedEventManagerInterface
     */
    public function getEvent($id)
    {
        if (!array_key_exists($id, $this->identifiers)) {
            return false;
        }

        return $this->identifiers[$id];
    }

    /**
     * Retrieve instance.
     *
     * @return SharedEventManagerInterface
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::setInstance(new static());
        }

        return static::$instance;
    }

    /**
     * Set the singleton to a specific {@link SharedEventManagerInterface} instance.
     *
     * @param SharedEventManagerInterface $instance
     *
     * @return void
     */
    public static function setInstance(SharedEventManagerInterface $instance)
    {
        static::$instance = $instance;
    }

    /**
     * Is a singleton instance defined?.
     *
     * @return boolean
     */
    public static function hasInstance()
    {
        return (static::$instance instanceof SharedEventManagerInterface);
    }

    /**
     * Reset the singleton instance.
     *
     * @return void
     */
    public static function resetInstance()
    {
        static::$instance = null;
    }
}
