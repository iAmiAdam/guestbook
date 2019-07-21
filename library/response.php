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
    // The content type, must be one of the above.
    private $contentType;
    private $headers = [];

    /**
     * Set member variables, assumes content is HTML if no type is provided.
     *
     * @param \string $response The response text from the controller.
     * @param \string $type An optional content type.
     */
    public function __construct($response, $type = self::TEXT_HTML)
    {
        $this->content = $response;
        $this->contentType = $type;
    }

    /**
     * Echo out the provided content, set headers.
     */
    public function send()
    {
        if(!headers_sent()) {
            header("Content-Type: $this->contentType");
            foreach($this->headers AS $header => $value) {
                header("$header: $value");
            }
        }
        echo $this->content;
    }

    /**
     *
     */
    public function setHeader(string $header, string $value)
    {
        $this->headers[$header] = $value;
    }
}