<?php
/*
 * This file is part of the SDPHP Lifeline Package.
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */
namespace SDPHP\Lifeline;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Description of Reporter
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 */
class MyLifeline
{
    protected $dispatcher;
    protected $credentials;
    protected $dateRange;

    public function __construct() {
        $this->dispatcher = new EventDispatcher();
    }

    public function getLifeline($decades = 0)
    {
        $event = new GenericEvent();

        $this->dispatcher->dispatch('lifeline.before', $event);

        try {
            for ($i = 0; $i < $decades; $i++) {

                $event[$i] = $this->setupDecade($i);
                $event['current_decade'] = $i;

                $this->dispatcher->dispatch('lifeline.decade.'.$i, $event);
            }
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $this->dispatcher->dispatch('lifeline.after', $event);
        $arguments = $event->getArguments();
        unset($arguments['current_decade']);
        $lifelineString = implode('', $arguments);

        return $lifelineString;
    }

    /**
     *
     * @param \Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->addSubscriber($subscriber);
    }

    /**
     *
     * @param string $eventName
     * @param $listener
     * @param int $priority
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    private function setupDecade($decade)
    {
        $year = $decade * 10;
        $start = $year;
        $end = $year+9;
        return 'My Life from year ' . $start . ' to ' . $end . ': ';
    }
}
