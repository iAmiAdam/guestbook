<?php
namespace adamjsmith\guestbook\application\controllers;

use adamjsmith\guestbook\application\models\Setting;
use adamjsmith\guestbook\library\Controller;
use adamjsmith\guestbook\library\Response;

/**
 * Responsible for updating settings from the UI.
 *
 * @package adamjsmith\guestbook\application\controllers
 */
class SettingsController extends Controller
{
    private $adminRequired = array("view", "update");

    /**
     * Create the view of all settings in the database.
     *
     * @return Response The assembled view.
     */
    public function view()
    {
        $title = "Guestbook | Settings";
        $settings = Setting::getAll();
        $admin = $this->currentUser->isAdmin();
        ob_start();
        include("application/views/settings/all.php");
        $view = ob_get_clean();
        return new Response($view);
    }

    /**
     * Update the value of a setting or return to null if the value submitted is the default value.
     *
     * @return Response True if successful, an error if not.
     */
    public function update()
    {
        $settingArray = [];
        $requiredParameters = ["setting_id", "value"];
        foreach($requiredParameters AS $parameter) {
            if(!array_key_exists($parameter, $_POST))
                return new Response(json_encode(["error" => "$parameter is required."]), Response::APP_JSON);

            $settingArray[$parameter] = stripslashes($_POST[$parameter]);
        }

        $result = Setting::getSome(["setting_id" => $settingArray["setting_id"]]);

        if(!$result)
            return new Response(json_encode(["error" => "Could not find setting."]), Response::APP_JSON);

        $setting = $result[0];

        if($setting->default_value == $settingArray["value"]) {
            $setting->value = null;
        } else {
            $setting->value = $settingArray["value"];
        }

        if(!$setting->save())
            return new Response(json_encode(["error" => "Could not update setting."]), Response::APP_JSON);

        return new Response(json_encode("true"), Response::APP_JSON);

    }
}