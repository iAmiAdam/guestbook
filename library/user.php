<?php
namespace adamjsmith\guestbook\library;

/**
 * Represents the user making the request to the framework.
 *
 * @package adamjsmith\guestbook\library
 */
class User
{
    /**
     * @var bool Specifies whether the user is logged in or not. ie. an admin.
     */
    private $authenticated = false;

    public function isAdmin()
    {
        return $this->authenticated;
    }
}