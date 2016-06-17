<?php
// Settings to make all errors more obvious during testing
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');



use There4\Slim\Test\WebTestCase;

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));
require_once PROJECT_ROOT . '/vendor/autoload.php';

// Initialize our own copy of the slim application
class LocalWebTestCase extends WebTestCase {

    public function getSlimInstance() {        
        require 'config/hubspot.php';
        

        

        $customConfig = array();

        $customConfig['hubspot'] = array();
        $customConfig['hubspot']['config'] = $hubspotConfig;
        

        $app = new \Slim\Slim(array(
            'version' => '0.0.0',
            'debug' => false,
            'mode' => 'testing',
            'custom' => $customConfig
        ));

        $app->add(new \Slim\Middleware\HttpBasicAuthentication([
            "realm" => "Protected",
            "relaxed" => array("local.dev"),
            "users" => [
                "auth" => "auth123"
            ]
        ]));

        // Include our core application file
        require PROJECT_ROOT . '/app/app.php';
        return $app;
    }

}

;
/* End of file bootstrap.php */