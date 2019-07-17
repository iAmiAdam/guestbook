<?php
namespace adamjsmith\guestbook\application\controllers;

use adamjsmith\guestbook\library\Controller;
use adamjsmith\guestbook\library\Response;

/**
 * Responsible for the messages part of the application.
 *
 * @package adamjsmith\guestbook\application\controllers
 */
class MessagesController extends Controller
{
    /**
     * Creates the view of all messages, the main page of the application.
     *
     * @return Response The HTML view.
     */
    public function view()
    {
        return new Response("test", Response::APP_JSON);
    }
}