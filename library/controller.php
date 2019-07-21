<?php
namespace adamjsmith\guestbook\library;

/**
 * The base class that all controllers are based off of.
 *
 * @package adamjsmith\guestbook\library
 */
class Controller
{
    /**
     * @var array A list of actions that require an authenticated user to be logged in.
     */
    private $adminRequired = array();
    /**
     * @var string The action to be executed.
     */
    private $action;
    /**
     * @var User The current user of the system, established by Application.
     */
    protected $currentUser;
    /**
     * @var Settings The loaded settings from the application object.
     */
    protected $settings;

    /**
     * Assign member variables
     *
     * @param \string $action
     * @param User $currentUser
     * @param Settings $settings
     */
    public function __construct($action, User $currentUser, Settings $settings)
    {
        $this->action = $action;
        $this->currentUser = $currentUser;
        $this->settings = $settings;
    }

    /**
     * @return bool True if all beforeAction items complete successfully, false if not.
     */
    public function beforeAction()
    {
        if(in_array($this->action, $this->adminRequired)) {
            if(!$this->currentUser->isAdmin())
                return false;
        }

        return true;
    }
}