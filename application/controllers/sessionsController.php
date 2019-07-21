<?php
namespace adamjsmith\guestbook\application\controllers;


use adamjsmith\guestbook\library\Controller;
use adamjsmith\guestbook\library\Response;
use adamjsmith\guestbook\library\User;

/**
 * Responsible for logging admin users in and out.
 *
 * Very simple session based system, no persistence available.
 *
 * @package adamjsmith\guestbook\application\controllers
 */
class SessionsController extends Controller
{
    /**
     * See if a user can be found, check the password against the one given, create a token and update the user if so.
     * Also store that token as a session variable.
     *
     * @return Response True if a login is successful, provides an error message if not.
     */
    public function create()
    {
        $userArray = [];
        $requiredParameters = ["user_name", "user_password"];
        foreach($requiredParameters AS $parameter) {
            if(!array_key_exists($parameter, $_POST))
                return new Response(json_encode(["error" => "$parameter is required."]), Response::APP_JSON);

            $userArray[$parameter] = stripslashes($_POST[$parameter]);
        }

        $users = User::getSome(["user_name" => strtolower($userArray["user_name"])]);

        if(!$users)
            return new Response(json_encode(["error" => "Could not find user with that name."]), Response::APP_JSON);

        $user = $users[0];

        if(!password_verify($userArray["user_password"], $user->user_password))
            return new Response(json_encode(["error" => "Incorrect password, could not log you in."]), Response::APP_JSON);

        $token = md5($user->user_name.date("YmdHis"));
        $user->session_token = $token;

        if(!$user->save())
            return new Response(json_encode(["error" => "Could not create session, please try again."]), Response::APP_JSON);

        $_SESSION["token"] = $token;

        return new Response(json_encode(true), Response::APP_JSON);
    }

    /**
     * Destroy the session token and redirect the user.
     *
     * @return Response
     */
    public function logout()
    {
        unset($_SESSION["token"]);

        $response = new Response("Redirecting");
        $response->setHeader("Location", "home");
        return $response;
    }
}