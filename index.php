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

$application = new Application();
