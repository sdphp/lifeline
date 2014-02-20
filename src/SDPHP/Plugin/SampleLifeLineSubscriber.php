<?php
/*
 * This file is part of the SDPHP lifeline Package.
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */
namespace SDPHP\Plugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * SampleLifeLineSubscriber - Description.
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 */
class SampleLifeLineSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'lifeline.before' => array('onBefore', 0),
            'lifeline.decade.0' => array('onDecade0', 0),
            'lifeline.decade.1' => array('onDecade1', 0),
            'lifeline.decade.2' => array('onDecade2', 0),
            'lifeline.after' => array('onAfter', 0),
        );
    }

    public function onBefore(Event $event)
    {
        $event['before'] = '<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">';
        $event['before'] .= '<div class="page-header"><h1>Hello, My name is Bot <small>and this is my lifeline!</small></h1></div>';
    }

    public function onDecade0(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] .= 'I was born<br><hr>';
    }

    public function onDecade1(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] .= 'I was a teenager<br><hr>';
    }

    public function onDecade2(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] .= 'I Went to college<br><hr>';
    }

    public function onAfter(Event $event)
    {
        $event['after'] = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
        $event['after'] .= '<script src="../public/js/bootstrap.min.js"></script>';
    }
}