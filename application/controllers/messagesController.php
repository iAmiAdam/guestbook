<?php
namespace adamjsmith\guestbook\application\controllers;

use adamjsmith\guestbook\application\models\Message;
use adamjsmith\guestbook\library\Controller;
use adamjsmith\guestbook\library\Response;

/**
 * Responsible for the messages part of the application.
 *
 * @package adamjsmith\guestbook\application\controllers
 */
class MessagesController extends Controller
{
    private $adminRequired = array("delete");

    /**
     * Creates the view of all messages, the main page of the application.
     *
     * @return Response The HTML view.
     */
    public function view()
    {
        $title = "Guestbook";
        $allMessages = Message::getSome(["approved" => 1]);
        $admin = $this->currentUser->isAdmin();
        $test = include("application/views/messages/all.php");
        return new Response($test);
    }

    /**
     * Create a new guestbook message, checks whether the message should be auto approved, according to settings.
     *
     * @return Response Either the new message_id on success or an array with error as the first key.
     */
    public function create()
    {
        $messageArray = [];
        $requiredParameters = ["name", "message"];
        foreach($requiredParameters AS $parameter) {
            if(!array_key_exists($parameter, $_POST))
                return new Response(json_encode(["error" => "$parameter is required"]), Response::APP_JSON);

            $messageArray[$parameter] = stripslashes($_POST[$parameter]);
        }

        if(strlen($messageArray["name"]) < 3 || strlen($messageArray["name"] > 40))
            return new Response(json_encode(["error" => "Name must be between 3 and 40 characters."]), Response::APP_JSON);

        if(strlen($messageArray["message"]) < 40 || strlen($messageArray["message"] > 500))
            return new Response(json_encode(["error" => "Message must be between 40 and 500 characters."]), Response::APP_JSON);

        if(!$this->settings->approval)
            $messageArray["approved"] = 1;

        $message = new Message($messageArray);

        if($message->save()) {
            return new Response(json_encode([$message->message_id]), Response::APP_JSON);
        } else {
            return new Response(json_encode(["error" => "Could not leave your message, please try agai.n"]), Response::APP_JSON);
        }
    }

    /**
     * Accept a messageID and try to delete it.
     *
     * @return Response True if successfully deleted or an error if not.
     */
    public function delete()
    {
        if(!array_key_exists("messageID", $_POST))
            return new Response(json_encode(["error" => "messageID is required"]), Response::APP_JSON);

        $results = Message::getSome(["message_id" => $_POST["messageID"]]);

        if(!$results)
            return new Response(json_encode(["error" => "Could not find the message to delete."]), Response::APP_JSON);

        $message = $results[0];

        $delete = $message->delete();

        if(!$delete)
            return new Response(json_encode(["error" => "Could not delete the message"]), Response::APP_JSON);

        return new Response(json_encode(true), Response::APP_JSON);
    }
}