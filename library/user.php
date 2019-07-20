<?php
namespace adamjsmith\guestbook\library;

/**
 * Represents the user making the request to the framework.
 *
 * @package adamjsmith\guestbook\library
 */
class User extends Model
{
    protected static $tableName = "users";
    protected static $primaryKey = "user_id";
    /**
     * @var bool Specifies whether the user is logged in or not. ie. an admin.
     */
    private $authenticated = false;

    /**
     * If a user array is provided, the user must be an admin.
     *
     * @param array|null $object Either a provided database row or nothing.
     */
    public function __construct($object = null)
    {
        parent::__construct($object);

        // If there is a user array, the user has to be an admin.
        if($object["user_name"])
            $this->authenticated = true;
    }

    /**
     * Return whether the admin is a user or not.
     *
     * @return bool True/False
     */
    public function isAdmin()
    {
        return $this->authenticated;
    }
}