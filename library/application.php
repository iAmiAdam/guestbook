<?php

namespace adamjsmith\guestbook\library;

use adamjsmith\guestbook\config\Config;
use adamjsmith\guestbook\config\Routing;

/**
 * The main application responsible for instantiating objects necessary for running. Also responsible for dispatching
 * controller calls and sending the provided response.
 *
 * @package adamjsmith\guestbook\library
 */
class Application
{
    // An object of config variables, for now it just holds the database connection details.
    private $config;
    // PDO object.
    private $db;
    // An object of settings from the database.
    private $settings;
    // The routing object.
    private $routes;
    // The controller as specified from $routes.
    private $controller;
    // The action as specified from $routes.
    private $action;

    public function __construct()
    {
        if(!$this->loadConfig()) {
            echo "Could not load all necessary config";
            die();
        }

        $this->createDatabase();

        if(!$this->loadSettings()) {
            echo "Could not load all necessary settings";
            die();
        };

        $this->routes = new Routing();

        $url = "/";

        if(preg_replace('/\s+/', '', $_GET["url"]) != '')
            $url = $_GET["url"];
        
        $this->routeURL($url);
    }

    /**
     * Reads variables from config.php and loads into the array.
     *
     * @return bool True if all necessary config is loaded, false if not.
     */
    private function loadConfig()
    {
        $requiredVariables = ["dbHost", "dbPort", "dbUser", "dbPass", "dbName"];
        $this->config = new Config();

        foreach($requiredVariables AS $variable) {
            if(!isset($this->config->$variable))
                return false;
        }

        return true;
    }

    /**
     * Attempt creation of database object, escape if any errors occur.
     */
    private function createDatabase()
    {
        try {
            $this->db = new \PDO("mysql:host=".$this->config->dbHost.";dbname=".$this->config->dbName,
                $this->config->dbUser,
                $this->config->dbPass,
                array(
                    \PDO::ATTR_PERSISTENT => true
                ));
        } catch (\PDOException $e) {
            echo "Could not create database connection. The following error ocurred". $e->getMessage();
            die();
        }
    }

    /**
     * Attempt to create a settings object and load all settings from the database.
     *
     * @return bool Success if all settings are loaded, false if not.
     */
    private function loadSettings()
    {
        $this->settings = new Settings($this->db);
        return $this->settings->loadSettings();
    }

    /**
     * Find the controller & action that the user is looking for.
     *
     * @param string $url In the form of controller/action.
     */
    private function routeURL(string $url)
    {
        if(!$this->routes->exists($url)) {
            echo "We can't find what you're looking for, sorry about that.";
            die();
        }

        $route = $this->routes->routes[$url];
        $this->controller = $route["controller"];
        $this->action = $route["action"];
    }

    /**
     * Just need to unset the database connection, for now.
     */
    public function __destruct()
    {
        unset($this->db);
    }


}