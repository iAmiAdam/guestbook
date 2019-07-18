<?php

namespace adamjsmith\guestbook\library;

/**
 * Responsible for loading and by extension storing all available settings.
 *
 * @package adamjsmith\guestbook\library
 */
class Settings
{
    // Array of setting names to attempt to load
    private $settingNames = ["per_page", "approval"];
    // An associative array of the settings once they are loaded, either with their default or supplied value.
    private $settings;
    // The PDO database object that is injected.
    private $db;

    /**
     * Set DB and attempt to load settings listed above.
     *
     * @param \PDO $db Injected DB which should have been created by the application object.
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Loop $settingNames and load the value into the settings array.
     *
     * @return bool true if successfully loaded, false if not.
     */
    public function loadSettings()
    {
        foreach($this->settingNames AS $settingName) {
            $settingValue = $this->fetchSettingValueFromDB($settingName);
            if($settingValue === false)
                return false;

            $this->settings[$settingName] = $settingValue;
        }

        return true;
    }

    /**
     * Magic method to get any of the settings out of the private array. This way, settings can be referred to as
     * members of this class. eg $settings->per_page.
     *
     * @param $name string The name of the setting requested
     * @return mixed The value of the setting.
     */
    public function __get($name)
    {
        return $this->settings[$name];
    }

    /**
     * Attempt to fetch the setting from the DB.
     *
     * @param $settingName string The name of the setting
     * @return mixed The value of the setting if found, false if not found.
     */
    private function fetchSettingValueFromDB($settingName)
    {
        foreach($this->db->query("SELECT * FROM `settings` WHERE `name` = '$settingName'") AS $row) {
            if(!$row)
                return false;

            $value = $row["default_value"];

            if(!is_null($row["value"]))
                $value = $row["value"];

            return $value;
        };
    }

}