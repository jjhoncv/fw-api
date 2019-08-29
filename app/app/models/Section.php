<?php
require_once _model_ . 'Module.php';

class Section
{
  private $_id, $_name, $_url, $_module, $_status;

  public function __construct($id = 0)
  {
    $this->_id = $id;

    if ($this->_id > 0) {

      $sql = "SELECT * FROM sections WHERE id_section = '" . $this->_id . "'";
      $section = Db::getInstance()->query($sql);

      if ($section->count() > 0) {
        $row = $section->result();
        $this->_id = $row['id_section'];
        $this->_module = new Module($row['id_module']);
        $this->_name = $row['name_section'];
        $this->_url = $row['url_section'];
        $this->_status = $row['status_section'];
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

  public function getModule()
  {
    return $this->_module;
  }

  public function getStatus()
  {
    return $this->_status;
  }

  public function getUrl()
  {
    return $this->_url;
  }
}
