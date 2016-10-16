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

use Traversable;
use Zend\Stdlib\Parameters;

/**
 * An {@link AbstractListener} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\EventManager\Listener
 */
abstract class AbstractListener
{
    /**
     *
     *
     * @var ListenerOptions
     */
    protected $options;

    /**
     * Constructor to prevent {@link AbstractListener} from being loaded more than once.
     *
     * @param ListenerOptions|array|Traversable $options
     */
    public function __construct($options = null)
    {
        if (null === $options) {
            $options = new ListenerOptions();
        } elseif ((is_array($options) || $options instanceof Traversable) && !($options instanceof Parameters)) {
            $options = new ListenerOptions($options);
        }

        $this->setOptions($options);
    }

    /**
     * Get options.
     *
     * @return ListenerOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options.
     *
     * @param ListenerOptions $options
     *
     * @return static
     */
    public function setOptions(ListenerOptions $options)
    {
        $this->options = $options;

        return $this;
    }
}
