<?php
/**
 * Entry point for the MVC framework, includes necessary files and initiates the application object.
 */

namespace adamjsmith\guestbook;

use adamjsmith\guestbook\library\Application;

include_once("config/config.php");
include_once("config/routing.php");
include_once("library/application.php");
include_once("library/settings.php");
include_once("library/response.php");
include_once("library/controller.php");
include_once("library/model.php");
include_once("library/user.php");
include_once("application/controllers/messagesController.php");
include_once("application/controllers/sessionsController.php");
include_once("application/models/message.php");

$application = new Application();
$response = $application->handleRequest();
$response->send();
