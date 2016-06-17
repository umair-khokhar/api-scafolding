<?php
//turn all reporting on
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('UTC');

require 'vendor/autoload.php';
require 'config/hubspot.php';


\Slim\Slim::registerAutoloader();



$logWriter = new \Slim\LogWriter(fopen(__DIR__ . '/logs/log-' . date('Y-m-d', time()), 'a'));


$customConfig = array();

$customConfig['hubspot'] = array();
$customConfig['hubspot']['config'] = $hubspotConfig;





$app = new \Slim\Slim(array('log.writer' => $logWriter, 'custom' => $customConfig));



$app->add(new \Slim\Middleware\HttpBasicAuthentication(array(
    "realm" => "Protected",
    "secure" => false,
    "relaxed" => array("drillinginfo.com", "localhost"),
    "users" => array(
        "auth" => "auth123"
    )
)));

// Dependency Injection Containers
// -----------------------------------------------------------------------------
// In our unit tests, we'll mock these so that we can control our application
// state.

require_once __DIR__ . '/app/app.php';

$app->run();