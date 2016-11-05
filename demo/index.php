<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/10/31
 * Time: 15:10
 */

require __DIR__.'/../vendor/autoload.php';

Yezuozuo\Coverage\Injecter::Inject([
    'log_dir'=> __DIR__.'/../log',
    'ignore_file'=>__DIR__.'/../.gitignore',
    'is_repeat' => true
]);

require __DIR__.'/Event.php';
require __DIR__.'/User.php';

$eventId = 1;
$eventName = '活動1';
$eventStartDate = '2014-12-24 18:00:00';
$eventEndDate = '2014-12-24 20:00:00';
$eventDeadline = '2014-12-23 23:59:59';
$eventAttendeeLimit = 10;
$event = new Event($eventId,  $eventName, $eventStartDate, $eventEndDate, $eventDeadline, $eventAttendeeLimit);

$userId = 1;
$userName = 'User1';
$userEmail = 'user1@openfoundry.org  ';
$user = new User($userId, $userName, $userEmail);

// 使用者報名活動
$event->reserve($user);

$expectedNumber = 1;