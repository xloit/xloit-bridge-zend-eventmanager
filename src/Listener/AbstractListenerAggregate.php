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

namespace Xloit\Bridge\Zend\EventManager\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

/**
 * An {@link AbstractListenerAggregate} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\EventManager\Listener
 */
abstract class AbstractListenerAggregate extends AbstractListener implements ListenerAggregateInterface
{
    /**
     *
     *
     * @var array
     */
    protected $listeners = [];

    /**
     *
     *
     * @var array
     */
    protected $sharedListeners = [];

    /**
     * Detach all previously attached listeners.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     * @throws \Zend\EventManager\Exception\InvalidArgumentException
     */
    public function detach(EventManagerInterface $events)
    {
        $sharedManager = $events->getSharedManager();

        foreach ($this->listeners as $index => $listeners) {
            if ($listeners === $this) {
                continue;
            }

            if ($listeners instanceof ListenerAggregateInterface) {
                $listeners->detach($events);
            }

            $events->detach($listeners);
        }

        /** @var array $sharedListeners */
        foreach ($this->sharedListeners as $id => $sharedListeners) {
            foreach ($sharedListeners as $index => $listener) {
                if ($listener === $this) {
                    continue;
                }

                if ($listener instanceof ListenerAggregateInterface) {
                    $listener->detach($events);
                }

                $sharedManager->detach($listener, $id);
            }
        }
    }
}
