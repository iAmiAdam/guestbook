<?php
namespace adamjsmith\guestbook\config;

/**
 * Responsible for storing all known routes within the application, if the route doesn't exist in here it should not
 * be attempted to dispatch it.
 *
 * @package adamjsmith\guestbook\config
 */
class Routing
{
    // All known routes, array key is the route itself and the element of the array is the controller/action pairing.
    public $routes = array(
        "/" => array("controller" => "messages", "action" => "view"),
        "home" => array("controller" => "messages", "action" => "view"),
        "newMessage" => array("controller" => "messages", "action" => "create"),
        "login" => array("controller" => "sessions", "action" => "create"),
        "logout" => array("controller" => "sessions", "action" => "logout"),
        "deleteMessage" => array("controller" => "messages", "action" => "delete"),
        "editMessage" => array("controller" => "messages", "action" => "update"),
        "approve" => array("controller" => "messages", "action" => "approveView"),
        "approveMessage" => array("controller" => "messages", "action" => "approve")
    );

    /**
     * Checks to see if the route exists in the above array.
     *
     * @param string $route The route, should be in format controller/aciton.
     * @return bool True if the route exists, false if not.
     */
    public function exists(string $route)
    {
        return array_key_exists($route, $this->routes);
    }
}