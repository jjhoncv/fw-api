<?php
require_once _model_ . "Rest.php";
require_once _model_ . "Role.php";
require_once _model_ . "User.php";
require_once _model_ . "Token.php";

class Session extends Rest
{
    private $_user, $_token, $_code = 400;
    private $_data = array("error" => array(
        "status" => 400,
        "description" => "Unauthorized",
    ));

    public function __construct($token = '')
    {
        parent::__constructor();
        session_start();
        if (!$_SESSION['user'] || empty($_SESSION['user'])) {
            $_SESSION['user'] = new User();
        }
        $this->_user = $_SESSION['user'];
        $this->_token = new Token();

    }

    public function validAccess($username, $password)
    {
        $sql = "SELECT id_user FROM users WHERE login_user='" . $username . "' AND password_user='" . $password . "'";
        $users = Db::getInstance()->query($sql);

        if ($users->count() > 0) {
            $row = $users->result();
            $this->_user = new User($row['id_user']);
            $_SESSION['user'] = $this->_user;
            $this->_user->setLoggedIn(true);
            $this->_token->createToken(
                array('id' => $row['id_user'])
            );
            $this->_code = 200;
            $this->_data = array(
                "data" => array(
                    "token" => $this->_token->getToken(),
                ),
            );
        }
        $this->response(
            $this->json($this->_data)
            , $this->_code);
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        $this->_user = new User();
        $this->_user->setLogin("Visitante");
        $this->_user->setLoggedIn(false);
        $_SESSION['user'] = $this->_user;
        // header("Location: login.php");
    }
}
