<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/19/14
 * Time: 10:21 AM
 */

require_once __DIR__.'/../vendor/autoload.php';
use SDPHP\Lifeline\MyLifeline;
use SDPHP\Plugin\SampleLifeLineSubscriber;
use SDPHP\Plugin\SampleLifeLineListener;
$lifeline = new MyLifeline();

// Adding a subscriber example
//$lifelineSubscriber = new SampleLifeLineSubscriber();
//$lifeline->addSubscriber($lifelineSubscriber);

// Adding a listener example
//$listener = new SampleLifeLineListener();
//$lifeline->addListener('lifeline.before', array($listener, 'onBefore'));
//$lifeline->addListener('lifeline.decade.0', array($listener, 'onDecade0'));
//$lifeline->addListener('lifeline.decade.1', array($listener, 'onDecade1'));
//$lifeline->addListener('lifeline.decade.2', array($listener, 'onDecade2'));
//$lifeline->addListener('lifeline.after', array($listener, 'onAfter'));

echo $lifeline->getLifeline(3);