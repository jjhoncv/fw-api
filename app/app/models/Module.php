<?php
class Module
{
  private $_id, $_name;

  public function __construct($id = 0)
  {
    $this->_id = $id;

    if ($this->_id > 0) {
      $sql = "SELECT * FROM modules WHERE id_module = '" . $this->_id . "'";
      $module = Db::getInstance()->query($sql);
      if ($module->count() > 0) {
        $row = $module->result();
        $this->_id = $row['id_module'];
        $this->_name = $row['name_module'];
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
  public function __toString()
  {
    return $this->_id;
  }
}
