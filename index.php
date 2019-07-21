<?php
/**
 * Entry point for the MVC framework, includes necessary files and initiates the application object.
 */

namespace adamjsmith\guestbook;

use adamjsmith\guestbook\library\Application;

spl_autoload_register(function($class){
    // This will be in the form Author\App Name\Folder(s)\Class Name
    $classArray = explode("\\", $class);

    if($classArray[2] == "library") {
        include("library/" . $classArray[3] . ".php");
        return;
    }

    if($classArray[2] == "config") {
        include("config/" . $classArray[3] . ".php");
        return;
    }

    if($classArray[2] == "application") {
        include("application/" . $classArray[3] . "/" . $classArray[4] . ".php");
        return;
    }
});


$application = new Application();
$response = $application->handleRequest();
$response->send();
