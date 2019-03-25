<?php
class Role
{
    private $_id,
    $_name,
        $_order;

    public function __construct($id = 0)
    {
        $this->_id = $id;
        if ($this->_id > 0) {

            $sql = "SELECT name_role, order_role FROM roles WHERE id_role = '" . $this->_id . "'";
            $roles = Db::getInstance()->query($sql);

            if ($roles->count() > 0) {
                $row = $roles->result();

                $this->_name = $row['name_role'];
                $this->_order = $row['order_role'];
            }
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getorder()
    {
        return $this->_order;
    }

    public function __toString()
    {
        return $this->_name . ' ' . $this->_order;
    }
}
