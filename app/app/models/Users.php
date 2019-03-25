<?php
require_once _model_ . "User.php";

class Users
{
    private $_users = array();

    public function __construct()
    {
        $sql = "SELECT id_user FROM users";
        $users = Db::getInstance()->query($sql);

        if ($users->count() > 0) {
            $rows = $users->results();
            foreach ($rows as $row) {
                $this->_users[] = new User($row['id_user']);
            }
        }
    }

    public function getUsers()
    {
        return $this->_users;
    }
}
