<?php
namespace adamjsmith\guestbook\library;

/**
 * Repsonsible for returning content produced by controllers to index.php
 *
 * This class will set headers, such as content types as well as provide a function for echoing out content.
 *
 * @package adamjsmith\guestbook\library
 */
class Response
{
    // Consts for content types.
    const TEXT_HTML = "text/html";
    const APP_JSON = "application/json";
    // The content, provided by controllers, to be sent.
    private $content;

    /**
     * Set member variables, assumes content is HTML if no type is provided.
     *
     * @param string $response The response text from the controller.
     * @param string $type An optional content type.
     */
    public function __construct(string $response, $type = self::TEXT_HTML)
    {
        $this->content = $response;
    }

    /**
     * For now, echoes out the provided content. In time will set headers etc.
     */
    public function send()
    {
        echo $this->content;
    }
}