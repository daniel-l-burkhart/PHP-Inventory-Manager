<?php
session_start();

class Session
{

    public $msg;
    private $user_is_logged_in = false;

    /**
     * The constructor of the session class.
     * Session constructor.
     */
    function __construct()
    {
        $this->flash_msg();
        $this->userLoginSetup();
    }

    /**
     * Is the user logged in? - getter method of user_is_logged_in var
     * @return bool
     *      True if logged in, false otherwise
     */
    public function isUserLoggedIn()
    {
        return $this->user_is_logged_in;
    }

    /**
     * Logs in the user
     * @param $user_id
     *      The user ID
     */
    public function login($user_id)
    {
        $_SESSION['user_id'] = $user_id;
    }

    /**
     * Sets up the session for the user to log in
     */
    private function userLoginSetup()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_is_logged_in = true;
        } else {
            $this->user_is_logged_in = false;
        }

    }

    /**
     * Logs out the user - unset the userID.
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
    }

    /**
     * Msg function that sets the msg attribute of session to display to screen.
     * @param string $type
     *      The type of message - success | danger
     * @param string $msg
     *      The msg's content
     * @return mixed
     *      The message
     */
    public function msg($type = '', $msg = '')
    {
        if (!empty($msg)) {

            $_SESSION['msg'][$type] = $msg;
        } else {
            return $this->msg;
        }
    }

    /**
     * Flashes a message to the screen
     */
    private function flash_msg()
    {

        if (isset($_SESSION['msg'])) {
            $this->msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
        } else {
            $this->msg;
        }
    }
}

$session = new Session();
$msg = $session->msg();