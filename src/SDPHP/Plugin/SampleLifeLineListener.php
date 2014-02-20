<?php
/*
 * This file is part of the SDPHP lifeline Package.
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */
namespace SDPHP\Plugin;

use Symfony\Component\EventDispatcher\Event;

/**
 * SampleLifeLineListener - Description.
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 */
class SampleLifeLineListener
{
    public function onBefore(Event $event)
    {
        $event['before'] = '<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">';
        $event['before'] .= '<div class="jumbotron"><h1>Hello, My name is Bot and this is my lifeline!</h1></div><ul class="list-group">';
    }

    public function onDecade0(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] = '<li class="list-group-item">'.$event[$index].'I was born</li>';
    }

    public function onDecade1(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] = '<li class="list-group-item">'.$event[$index].'I was a teenager</li>';
    }

    public function onDecade2(Event $event)
    {
        $index = $event['current_decade'];
        $event[$index] = '<li class="list-group-item">'.$event[$index].'I Went to college</li>';
    }

    public function onAfter(Event $event)
    {
        $event['after'] = '<ul><script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
        $event['after'] .= '<script src="../public/js/bootstrap.min.js"></script>';
    }
}