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
    private $currentUser;

    /**
     * Controller constructor.
     * @param string $action
     */
    public function __construct(string $action, User $currentUser)
    {
        $this->action = $action;
        $this->currentUser = $currentUser;
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