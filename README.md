lifeline
========

Symfony Event Dispatcher exercise

##Overview
The lifeline excercie is a simple program that enables you to describe each decade of your life by creating "plugins" (AKA listeners/subscribers). 

For each decade you can add a listener/subscriber that will have access to the "lifeline" event. You can add images, strings, links, or anything you like and at the end print out the result!

This project has the latest version of twitter bootstrap (as of 2014-02-19) so you can include it and give some style to your personal life line.

##Installation

```
git git@github.com:sdphp/lifeline.git
cd lifeline
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

##Usage

Create a subscriber and add it under the SDPHP\Plugin namespace, or in the namespace of your choice:
```php
// src/SDPHP/Plugin/SampleLifeLineSubscriber.php
namespace SDPHP\Plugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

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

```

**OR use a listener**

```php
namespace SDPHP\Plugin;

use Symfony\Component\EventDispatcher\Event;

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
```

In `web/index.php` add the listener/subscriber to the `MyLifeline` class:

```php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
use SDPHP\Lifeline\MyLifeline;
use SDPHP\Plugin\SampleLifeLineSubscriber;
use SDPHP\Plugin\SampleLifeLineListener;
$lifeline = new MyLifeline();

// Adding a subscriber example
$lifelineSubscriber = new SampleLifeLineSubscriber();
$lifeline->addSubscriber($lifelineSubscriber);

// Adding a listener example
$listener = new SampleLifeLineListener();
$lifeline->addListener('lifeline.before', array($listener, 'onBefore'), 0);
$lifeline->addListener('lifeline.decade.0', array($listener, 'onDecade0'), 0);
$lifeline->addListener('lifeline.decade.1', array($listener, 'onDecade1'), 0);
$lifeline->addListener('lifeline.decade.2', array($listener, 'onDecade2'), 0);
$lifeline->addListener('lifeline.after', array($listener, 'onAfter'), 0);

echo $lifeline->getLifeline($DECADES);
```

##Events

|    Name     |  Description    |     Data       |
|:----------- |:--------------- |:-------------- |
| `lifeline.before`   |Before the life line is started. Ideal to include CSS files, titles or initialize tables or lists|  - Empty event. Data can be added in the `$event['before']`  index. But any non-numeric index will do as the event array will be merged at the end of the program. |
| `lifeline.decade.X` |  Event dispatched for every decade. The Decade number is X. Event will be dispatched as long as `X < $DECADES` where `$DECADES` is the number passed to the `MyLifeline::getLifeline` method. Decade is 0 indexed. | - The `before` value.
 - Event will contain the index `current_decade` which is the zero indexed decade. 
 - A numeric index for the current decade `X` will contain the default decade value: "'My Life from year ' . $start . ' to ' . $end . ': '" you can append to this value or overwrite it. 
 All the other decades will be available. |
| `lifeline.after`   |After the lifeline is done. Ideal to include JS files, and close any opened table or list tags.| - The `before` value.
- Every dacade entry|
